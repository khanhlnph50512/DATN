<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Mail\OrderSuccessMail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\ShippingMethod;
use App\Models\Client\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VnpayController extends Controller
{
    public function vnpayPayment(Request $request)
    {
        $vnp_TmnCode = "PNSZ29SP";
        $vnp_HashSecret = "MCFNSIB0KCZSNFE6LAFQIUH7KKKDKB6L";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');

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

        // Lấy phí vận chuyển
        $shippingMethod = ShippingMethod::find($request->shipping_method_id);
        $shippingFee = $shippingMethod?->price ?? 0;

        $grandTotal = $total + $shippingFee;
        $vnp_Amount = $grandTotal * 100; // VNPAY yêu cầu nhân 100

        $vnp_TxnRef = time();
        $vnp_OrderInfo = 'Thanh toan don hang';
        $vnp_OrderType = 'billpayment';
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
            $hashdata .= $hashdata ? '&' : '';
            $hashdata .= urlencode($key) . "=" . urlencode($value);
        }

        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnp_SecureHash;
        session([
            'shipping_method_id' => $request->shipping_method_id,
            'shipping_address'   => $request->shipping_address,
            'phone_number'       => $request->phone_number,
            'email'              => $request->email,
            'note'               => $request->note,
        ]);
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');

        if ($vnp_ResponseCode != '00') {
            return redirect()->route('client.checkout')->with('error', 'Thanh toán thất bại hoặc bị hủy!');
        }

        $user = Auth::user();
        $sessionId = session()->getId();
        $cartItems = Cart::with(['product', 'variation.size', 'variation.color', 'product.category', 'product.brand', 'product.primaryImage'])
            ->where(function ($q) use ($user, $sessionId) {
                $user ? $q->where('user_id', $user->id) : $q->where('session_id', $sessionId);
            })->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('client.checkout')->with('error', 'Giỏ hàng trống!');
        }

        // Lấy thông tin từ session
        $shippingMethodId = session('shipping_method_id');
        $shippingAddress = session('shipping_address');
        $phoneNumber = session('phone_number');
        $email = session('email');
        $note = session('note');

        $shippingMethod = ShippingMethod::find($shippingMethodId);
        $shippingFee = $shippingMethod?->price ?? 0;

        $total = $cartItems->sum(function ($item) {
            $price = $item->variation->price_sale ?? $item->variation->price ?? $item->product->price ?? 0;
            return $price * $item->quantity;
        });

        $grandTotal = $total + $shippingFee;

        $order = Order::create([
            'user_id' => $user?->id,
            'session_id' => $user ? null : $sessionId,
            'order_number' => strtoupper(Str::random(10)),
            'total_amount' => $grandTotal,
            'status' => 'pending',
            'payment_status' => 'paid',
            'payment_method' => 'vnpay',
            'shipping_address' => $shippingAddress,
            'phone_number' => $phoneNumber,
            'email' => $email,
            'note' => $note,
            'shipping_method_id' => $shippingMethodId,
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
            $variation = $item->variation;
            if ($variation->quantity >= $item->quantity) {
                $variation->decrement('quantity', $item->quantity);
            } else {
                return redirect()->route('client.checkout')->with('error', 'Sản phẩm "' . $item->product->name . '" không đủ số lượng.');
            }

            $product = $item->product;
            if ($product->quantity >= $item->quantity) {
                $product->decrement('quantity', $item->quantity);
            } else {
                return redirect()->route('client.checkout')->with('error', 'Sản phẩm "' . $product->name . '" không còn đủ tồn kho.');
            }
        }

        $cartItems->each->delete();
        session()->forget([
            'shipping_method_id',
            'shipping_address',
            'phone_number',
            'email',
            'note',
        ]);
        if ($order && $order->email) {
            Mail::to($order->email)->send(new OrderSuccessMail($order));
        }
        return redirect()->route('client.order-tracking')->with('success', 'Thanh toán thành công! Mã đơn: ' . $order->order_number);
    }
}
