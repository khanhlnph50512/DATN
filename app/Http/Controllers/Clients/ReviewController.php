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

        // Kiểm tra đã mua sản phẩm chưa
        $hasPurchased = Order::where('user_id', $user->id)
            ->where('status', 'delivered') // hoặc 'completed' tùy hệ thống
            ->whereHas('orderItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.');
        }

        // Kiểm tra đã đánh giá chưa
        $hasReviewed = Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if ($hasReviewed) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        // Validate và tạo review
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'pending', // hoặc 'approved' nếu không cần duyệt
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
