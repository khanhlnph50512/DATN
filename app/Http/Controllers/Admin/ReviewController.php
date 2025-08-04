<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::with('user', 'product')->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $newStatus = $request->input('status');

        // Nếu đã từng được duyệt hiển thị thì không được chuyển sang từ chối
        if ($review->status === 'approved' && $newStatus === 'rejected') {
            return redirect()->route('admin.reviews.index')
                ->with('error', 'Đánh giá đã hiển thị thì không thể chuyển sang từ chối.');
        }

        // Nếu trạng thái hiện tại là rejected thì không cho thay đổi nữa
        if ($review->status === 'rejected') {
            return redirect()->route('admin.reviews.index')
                ->with('error', 'Đánh giá đã bị từ chối và không thể thay đổi trạng thái.');
        }

        // Ngược lại thì cập nhật bình thường
        $review->status = $newStatus;
        $review->save();

        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật trạng thái đánh giá thành công');
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return back()->with('success', 'Xóa đánh giá thành công');
    }
}
