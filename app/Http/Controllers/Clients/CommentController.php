<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 'pending', // Chờ duyệt
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi và đang chờ duyệt.');
    }}
