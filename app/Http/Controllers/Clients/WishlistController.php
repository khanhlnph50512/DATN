<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $productId = $request->input('product_id');
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để yêu thích sản phẩm.']);
        }

        if ($user->wishlist()->where('product_id', $productId)->exists()) {
            $user->wishlist()->detach($productId);
            return response()->json(['removed' => true]);
        } else {
            $user->wishlist()->attach($productId);
            return response()->json(['added' => true]);
        }
    }

    public function index()
    {
          $user = User::find(Auth::id());
        $products = $user->wishlist()->with('primaryImage')->paginate(12);

        return view('client.wishlist.index', compact('products'));
    }
    public function remove($productId)
{
          $user = User::find(Auth::id());

    if ($user) {
        $user->wishlist()->detach($productId);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích.');
    }

    return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thao tác.');
}
}
