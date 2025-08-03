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
public function cancel($id)
{
    $order = Order::findOrFail($id);

    // Chỉ cho phép người sở hữu đơn hàng hoặc theo session
    $user = Auth::user();
    $sessionId = session()->getId();

    if (($user && $order->user_id !== $user->id) || (!$user && $order->session_id !== $sessionId)) {
        return redirect()->route('client.order-tracking')->with('error', 'Bạn không có quyền hủy đơn hàng này.');
    }

    // Chỉ cho hủy nếu đơn đang chờ xác nhận
    if ($order->status !== 'pending') {
        return redirect()->route('client.order-tracking')->with('error', 'Chỉ có thể hủy đơn hàng khi đang chờ xác nhận.');
    }

    // Cập nhật trạng thái
    $order->status = 'cancelled';
    $order->save();

    return redirect()->route('client.order-tracking')->with('success', 'Đơn hàng đã được hủy thành công.');
}


}
