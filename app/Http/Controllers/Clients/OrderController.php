<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function orderTracking()
{
    $user = Auth::user();
    $sessionId = session()->getId();

    $orders = Order::where(function ($query) use ($user, $sessionId) {
        if ($user) {
            $query->where('user_id', $user->id);
        } else {
            $query->where('session_id', $sessionId);
        }
    })
    ->with('orderItems','shippingMethod') // nếu cần dùng chi tiết
    ->orderBy('created_at', 'desc')
    ->get();

    return view('client.order.orderTracking', compact('orders'));
}

    /**
     * Show the form for creating a new resource.
     */
  public function showDetail($orderId)
    {
        $order = Order::with('orderItems','shippingMethod')->find($orderId);

        if (!$order) {
            return redirect()->route('client.order-tracking')->with('error', 'Không tìm thấy đơn hàng.');
        }

        return view('client.order.orderDetail', compact('order'));
    }


}
