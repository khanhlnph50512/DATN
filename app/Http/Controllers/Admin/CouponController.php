<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Coupon;

class CouponController extends Controller
{
      public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }
public function show($id)
{


}
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:coupons,code',
            'description' => 'nullable|string',
            'discount_amount' => 'nullable|numeric',
            'discount_percent' => 'nullable|numeric',
            'minimum_order_amount' => 'nullable|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'active' => 'boolean',
        ]);

        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Tạo mã giảm giá thành công');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string',
            'discount_amount' => 'nullable|numeric',
            'discount_percent' => 'nullable|numeric',
            'minimum_order_amount' => 'nullable|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'active' => 'boolean',
        ]);

        $coupon->update($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Cập nhật thành công');
    }

   public function destroy(Coupon $coupon)
{


    $coupon->delete();
    return redirect()->route('admin.coupons.index')->with('success', 'Xóa mềm thành công');
}
    public function trash()
{
    $coupons = Coupon::onlyTrashed()->latest()->paginate(10);
    return view('admin.coupons.trash', compact('coupons'));
}

// Khôi phục
public function restore($id)
{
    $coupon = Coupon::onlyTrashed()->findOrFail($id);
    $coupon->restore();

    return redirect()->route('admin.coupons.trash')->with('success', 'Khôi phục mã giảm giá thành công');
}

// Xóa vĩnh viễn
public function forceDelete($id)
{
    $coupon = Coupon::onlyTrashed()->findOrFail($id);
    $coupon->forceDelete();

    return redirect()->route('admin.coupons.trash')->with('success', 'Xóa vĩnh viễn mã giảm giá');
}
}
