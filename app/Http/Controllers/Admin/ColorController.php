<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        Color::create($request->only('name', 'code'));

        return redirect()->back()->with('success', 'Thêm màu thành công!');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $color->update($request->only('name', 'code'));

        return redirect()->back()->with('success', 'Cập nhật màu thành công!');
    }

   public function destroy(Color $color)
{
    if ($color->productVariations()->count() > 0) {
        return redirect()->back()->withErrors(['error' => 'Không thể xóa màu vì vẫn còn sản phẩm sử dụng màu này.']);
    }

    $color->delete();
    return redirect()->back()->with('success', 'Xóa màu thành công!');
}
}
