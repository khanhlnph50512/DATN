<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
     public function index()
    {
        $comments = Comment::with('user', 'product')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();

        return back()->with('success', 'Bình luận đã được duyệt.');
    }

    public function reject($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'rejected';
        $comment->save();

        return back()->with('success', 'Bình luận đã bị từ chối.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }
}
