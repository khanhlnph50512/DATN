<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:brands,name',
        ]);

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->back()->with('success', 'Thêm thương hiệu thành công!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|unique:brands,name,' . $brand->id,
        ]);

        $brand->update($request->only('name'));
        return redirect()->back()->with('success', 'Cập nhật thương hiệu thành công!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'Xóa thương hiệu thành công!');
    }
}
