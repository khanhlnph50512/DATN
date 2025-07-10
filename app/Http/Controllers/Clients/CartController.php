<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ProductVariation;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        $items = Cart::with('product')->where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
                ->orWhere('session_id', $sessionId);
        })->get();

        // Nếu có giá giảm thì dùng, không thì dùng giá gốc
        $total = $items->sum(function ($item) {
            $price = $item->product->price_sale ?: $item->product->price;
            return $price * $item->quantity;
        });

        return view('client.carts.index', compact('items', 'total'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $variation = ProductVariation::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id
        ])->first();

        if (!$variation) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Không tìm thấy biến thể sản phẩm.'], 404);
            }
            return back()->with('error', 'Không tìm thấy biến thể sản phẩm.');
        }

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where('variation_id', $variation->id)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $request->product_id,
                'variation_id' => $variation->id,
                'quantity' => $request->quantity,
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Đã thêm vào giỏ hàng!']);
        }

        return redirect()->route('client.carts.index')->with('success', 'Đã thêm vào giỏ hàng!');
    }
    public function update(Request $request)
    {
        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        $items = Cart::where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
                ->orWhere('session_id', $sessionId);
        })->with(['product', 'variation'])->get();

        // ✅ Tính tổng tiền
        $total = $items->sum(function ($item) {
            $price = $item->variation->price_sale ?? $item->variation->price ?? 0;
            return $price * $item->quantity;
        });

        return view('client.carts.index', compact('items', 'total'));
    }
}
