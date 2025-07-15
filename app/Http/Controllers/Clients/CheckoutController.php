<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
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

        return view('client.checkout.index', compact('cartItems', 'total'));
    }
    public function processOrder(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'email' => 'nullable|email',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:cod,online',
        ]);

        $user = Auth::user();
        $sessionId = $request->session()->getId();

        $cartItems = \App\Models\Client\Cart::with(['product', 'variation'])
            ->where(function ($q) use ($user, $sessionId) {
                $user ? $q->where('user_id', $user->id) : $q->where('session_id', $sessionId);
            })
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('client.checkout')->with('error', 'Giỏ hàng trống!');
        }

        $total = $cartItems->sum(function ($item) {
            $price = $item->variation->price_sale ?? $item->variation->price ?? $item->product->price ?? 0;
            return $price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => $user?->id,
            'session_id' => $user ? null : $sessionId,
            'order_number' => strtoupper(Str::random(10)),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'note' => $request->note,
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

        // Xóa giỏ hàng
        $cartItems->each->delete();

        // ✅ Chuyển hướng sau khi đặt hàng thành công
        return redirect()
            ->route('client.order-tracking') // hoặc truyền ID nếu bạn dùng kiểu `order-tracking/{id}`
            ->with('success', 'Đặt hàng thành công! Mã đơn: ' . $order->order_number);
    }
}
