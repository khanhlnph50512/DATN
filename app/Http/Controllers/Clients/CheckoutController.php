<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\ShippingMethod;
use App\Models\Client\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
   public function showCheckoutPage()
{
    $userId = Auth::id();
    $sessionId = session()->getId();

    $cartItems = Cart::with(['product', 'variation.size', 'variation.color'])
        ->where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
              ->orWhere('session_id', $sessionId);
        })->get();

    $total = $cartItems->sum(function ($item) {
        $price = $item->variation->price_sale ?? $item->variation->price ?? $item->product->price;
        return $price * $item->quantity;
    });

    $shippingMethods = ShippingMethod::all();
    $shippingFee = 0;

    return view('client.checkout.index', compact('cartItems', 'total', 'shippingMethods', 'shippingFee'));
}
    public function processOrder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'shipping_address' => 'required|string|max:500',
        'email' => 'nullable|email',
        'note' => 'nullable|string',
        'payment_method' => 'required|in:cod,online',
        'shipping_method_id' => 'required|exists:shipping_methods,id',
    ]);

    $user = Auth::user();
    $sessionId = $request->session()->getId();

    $cartItems = Cart::with(['product', 'variation'])
        ->where(function ($q) use ($user, $sessionId) {
            $user ? $q->where('user_id', $user->id) : $q->where('session_id', $sessionId);
        })->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('client.checkout')->with('error', 'Giỏ hàng trống!');
    }

    $total = $cartItems->sum(function ($item) {
        $price = $item->variation->price_sale ?? $item->variation->price ?? $item->product->price ?? 0;
        return $price * $item->quantity;
    });

    $shippingMethod = ShippingMethod::find($request->shipping_method_id);
    $shippingFee = $shippingMethod?->price ?? 0;
    $grandTotal = $total + $shippingFee;

    $order = Order::create([
        'user_id' => $user?->id,
        'session_id' => $user ? null : $sessionId,
        'order_number' => strtoupper(Str::random(10)),
        'total_amount' => $grandTotal,
        'status' => 'pending',
        'payment_status' => 'unpaid',
        'payment_method' => $request->payment_method,
        'shipping_address' => $request->shipping_address,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'note' => $request->note,
        'shipping_method_id' => $shippingMethod->id,
    ]);

    foreach ($cartItems as $item) {
        $price = $item->variation->price_sale ?? $item->variation->price ?? $item->product->price ?? 0;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'variation_id' => $item->variation_id,
            'quantity' => $item->quantity,
            'price' => $price,
            'discount' => 0,
            'final_price' => $price * $item->quantity,
            'product_name' => $item->product->name,
            'variation_name' => $item->variation->color->name . ' - ' . $item->variation->size->name,
            'category_name' => $item->product->category->name ?? '---',
            'brand_name' => $item->product->brand->name ?? '---',
            'image' => $item->product->primaryImage->image_url ?? null,
        ]);
    }

    $cartItems->each->delete();
if (session()->has('applied_coupon')) {
    $coupon = Coupon::where('code', session('applied_coupon'))->first();

    if ($coupon && $coupon->usage_limit !== null && $coupon->usage_limit > 0) {
        $coupon->decrement('usage_limit');
    }

   session()->forget('applied_coupon');
session()->forget('coupon_discount');
}
    return redirect()
        ->route('client.order-tracking')
        ->with('success', 'Đặt hàng thành công! Mã đơn: ' . $order->order_number);
}

}
