<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Client\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        $orderId = $request->input('order_id');

        // 1. Tìm đúng đơn hàng mà user đã mua sản phẩm này
        $order = Order::where('id', $orderId)
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereHas('orderItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->first();

        if (!$order) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua và hoàn thành.');
        }

        // 2. Kiểm tra đã đánh giá sản phẩm này trong đơn hàng đó chưa
        $hasReviewed = Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->where('order_id', $orderId)
            ->exists();

        if ($hasReviewed) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi.');
        }

        // 3. Validate
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // 4. Tạo review
        Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'order_id' => $orderId,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
