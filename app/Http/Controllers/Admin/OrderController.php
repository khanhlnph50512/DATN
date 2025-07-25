<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết đơn hàng.
     */
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Cập nhật trạng thái đơn hàng.
     */
   public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $currentStatus = $order->status;
    $newStatus = $request->input('status');

    // Danh sách các trạng thái có thể chuyển tới từ trạng thái hiện tại
    $allowedTransitions = [
        'pending' => ['processing', 'cancelled'],
        'processing' => ['shipping', 'cancelled'],
        'shipping' => ['delivered', 'returned'],
        'delivered' => [],
        'cancelled' => [],
        'returned' => [],
    ];

    if (!in_array($newStatus, $allowedTransitions[$currentStatus])) {
        return redirect()->back()->with('error', 'Không thể chuyển từ trạng thái hiện tại sang trạng thái đã chọn.');
    }

    $order->status = $newStatus;
    $order->save();

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
}
    /**
     * Xóa đơn hàng (soft delete nếu cần).
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đã xóa đơn hàng.');
    }
}
