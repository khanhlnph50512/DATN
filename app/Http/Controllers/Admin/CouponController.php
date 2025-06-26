<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.coupons.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'usage_limit' => 'required|integer',
            'active' => 'boolean',
            'user_ids' => 'array',
            'product_ids' => 'array',
        ]);

        $coupon = Coupon::create($data);
        $coupon->users()->sync($request->user_ids);

        return redirect()->route('admin.coupons.index')->with('success', 'Tạo mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        return view('admin.coupons.show', compact('coupon'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { {
            $coupon = Coupon::findOrFail($id);

            $request->validate([
                'code' => 'required|string',
                'description' => 'nullable|string',
                'discount_amount' => 'nullable|numeric|min:0',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'minimum_order_amount' => 'nullable|numeric|min:0',
                'valid_from' => 'required|date',
                'valid_until' => 'required|date|after_or_equal:valid_from',
                'usage_limit' => 'nullable|integer|min:0',
                'active' => 'required|boolean',
            ]);

            $coupon->update($request->all());

            return redirect()->route('admin.coupons.index')->with('success', 'Cập nhật mã giảm giá thành công!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Đã xoá mã vào thùng rác.');
    }
    public function trash()
    {
        $coupons = Coupon::onlyTrashed()->latest()->paginate(10);
        return view('admin.coupons.trash', compact('coupons'));
    }
    public function restore($id)
    {
        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->restore();

        return redirect()->route('admin.coupons.trash')->with('success', 'Đã khôi phục mã!');
    }

    public function forceDelete($id)
    {
        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->forceDelete();

        return redirect()->route('admin.coupons.trash')->with('success', 'Đã xoá vĩnh viễn!');
    }
}
