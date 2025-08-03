<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:sizes,name',
        ]);

        Size::create($request->only('name'));

        return redirect()->back()->with('success', 'Thêm size thành công!');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:sizes,name,' . $size->id,
        ]);

        $size->update($request->only('name'));

        return redirect()->back()->with('success', 'Cập nhật sizes thành công!');
    }

   
    public function destroy(Size $size)
{
    if ($size->productVariations()->count() > 0) {
        return redirect()->back()->withErrors(['error' => 'Không thể xóa size vì vẫn còn sản phẩm sử dụng size này.']);
    }

    $size->delete();
    return redirect()->back()->with('success', 'Xóa size thành công!');
}
}
