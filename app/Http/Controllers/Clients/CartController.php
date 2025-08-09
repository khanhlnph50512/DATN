<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
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

        $items = Cart::with([
            'product.category',
            'product.brand',
            'product.primaryImage',
            'variation.size',
            'variation.color'
        ])->where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
                ->orWhere('session_id', $sessionId);
        })->get();
        if ($items->isEmpty()) {
            session()->forget('applied_coupon');
            session()->forget('coupon_discount');
        }
        // Tính tổng tiền dựa theo giá đã lưu trong bảng carts
        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
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

        // Ưu tiên dùng giá khuyến mãi nếu có
        $price = $variation->price_sale ?? $variation->price;

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where('variation_id', $variation->id)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;

            if ($newQuantity > $variation->quantity) {
                $maxAddable = max(0, $variation->quantity - $cartItem->quantity);
                $message = $maxAddable > 0
                    ? "Chỉ có thể thêm thêm {$maxAddable} sản phẩm nữa vào giỏ."
                    : "Bạn đã thêm tối đa số lượng sản phẩm hiện có.";

                if ($request->expectsJson()) {
                    return response()->json(['error' => $message], 400);
                }
                return back()->with('error', $message);
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            if ($request->quantity > $variation->quantity) {
                $message = "Chỉ còn {$variation->quantity} sản phẩm trong kho.";
                if ($request->expectsJson()) {
                    return response()->json(['error' => $message], 400);
                }
                return back()->with('error', $message);
            }

            Cart::create([
                'product_id' => $request->product_id,
                'variation_id' => $variation->id,
                'quantity' => $request->quantity,
                'price' => $price,
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

        // Tính tổng tiền dựa trên giá đã lưu
        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('client.carts.index', compact('items', 'total'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::with('variation')->find($id);

        if (!$cartItem) {
            return back()->with('error', 'Không tìm thấy sản phẩm trong giỏ.');
        }

        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        if (($userId && $cartItem->user_id == $userId) || (!$userId && $cartItem->session_id == $sessionId)) {
            if ($request->quantity > $cartItem->variation->quantity) {
                return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho.');
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            return back()->with('success', 'Cập nhật số lượng thành công.');
        }

        return back()->with('error', 'Không có quyền cập nhật mục này.');
    }

    public function remove($id, Request $request)
    {
        $cartItem = Cart::find($id);
        if (!$cartItem) {
            return back()->with('error', 'Không tìm thấy sản phẩm trong giỏ.');
        }

        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        if (($userId && $cartItem->user_id == $userId) || (!$userId && $cartItem->session_id == $sessionId)) {
            $cartItem->delete();
            return back()->with('success', 'Xóa sản phẩm khỏi giỏ thành công.');
        }

        return back()->with('error', 'Không có quyền xóa mục này.');
    }

    public function clear(Request $request)
    {
        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        Cart::where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
                ->orWhere('session_id', $sessionId);
        })->delete();

        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $currentCode = session('applied_coupon');

        // Nếu đã có mã trong session
        if ($currentCode) {
            if ($currentCode === $request->coupon_code) {
                return back()->with('coupon_error', 'Bạn đã thêm mã giảm giá này rồi.');
            } else {
                return back()->with('coupon_error', 'Chỉ được áp dụng 1 mã giảm giá duy nhất.');
            }
        }

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->first();

        if (!$coupon) {
            return back()->with('coupon_error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }

        if ($coupon->usage_limit !== null && $coupon->usage_limit <= 0) {
            return back()->with('coupon_error', 'Mã giảm giá đã đạt giới hạn sử dụng.');
        }

        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        $items = Cart::where(function ($q) use ($userId, $sessionId) {
            $q->when($userId, fn($q) => $q->where('user_id', $userId))
                ->orWhere('session_id', $sessionId);
        })->get();

        $total = $items->sum(fn($item) => $item->price * $item->quantity);
        $discountValue = $coupon->discount_amount ?? ($coupon->discount_percent ? ($total * $coupon->discount_percent / 100) : 0);
        if ($discountValue >= $total) {
            return back()->with('coupon_error', 'Giá trị giảm phải nhỏ hơn tổng giá trị đơn hàng.');
        }
        if ($coupon->minimum_order_amount && $total < $coupon->minimum_order_amount) {
            return back()->with('coupon_error', 'Đơn hàng chưa đạt mức tối thiểu để sử dụng mã giảm giá.');
        }

        session([
            'applied_coupon' => $coupon->code,
            'coupon_discount' => $coupon->discount_amount ?? ($coupon->discount_percent ? ($total * $coupon->discount_percent / 100) : 0),
        ]);

        return back()->with('coupon_success', 'Áp dụng mã giảm giá thành công!');
    }
    public function removeCoupon()
    {
        session()->forget('applied_coupon');
        session()->forget('coupon_discount');

        return back()->with('success', 'Đã xóa mã giảm giá.');
    }
}
