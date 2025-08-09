<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Models\Admin\ProductVariation;
use App\Models\Admin\Size;
use App\Models\Client\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category', 'primaryImage'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form thêm
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create', compact('brands', 'categories', 'sizes', 'colors'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {

        $request->validate([
            'name'          => 'required|string|max:255',
            'brand_id'      => 'required|exists:brands,id',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'nullable|numeric',
            'price_sale'    => 'nullable|numeric',
            'status'        => 'required|boolean',
            'images.*'      => 'image|mimes:jpg,jpeg,png',
            'primary_image' => 'required|integer',
            'variations.*.color_id'   => 'required|exists:colors,id',
            'variations.*.size_id'    => 'required|exists:sizes,id',
            'variations.*.price'      => 'required|numeric',
            'variations.*.price_sale' => 'nullable|numeric',
            'variations.*.quantity'   => 'required|integer',
            'gender' => 'required|in:nam,nu,unisex',

        ]);

        try {
            DB::beginTransaction();

            $product = Product::create([
                'name'        => $request->name,
                'brand_id'    => $request->brand_id,
                'category_id' => $request->category_id,
                'price'       => $request->price,
                'price_sale'  => $request->price_sale,
                'status'      => $request->status,
                'gender' => $request->gender,
                'description' => $request->description,

            ]);

            // Xử lý ảnh
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url'  => $path,
                        'is_primary' => ($index == $request->primary_image) ? 1 : 0,
                    ]);
                }
            }

            // Thêm các biến thể
            if ($request->has('variations')) {

                foreach ($request->variations as $variation) {
                    ProductVariation::create([
                        'product_id'  => $product->id,
                        'color_id'    => $variation['color_id'],
                        'size_id'     => $variation['size_id'],
                        'price'       => $variation['price'],
                        'price_sale'  => $variation['price_sale'],
                        'quantity'    => $variation['quantity'],
                    ]);
                }
                $product->quantity = $product->variations()->sum('quantity');
                $product->save();
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $product = Product::with(['brand', 'category', 'images', 'variations.color', 'variations.size'])
            ->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::with(['images', 'variations'])->findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.products.edit', compact('product', 'brands', 'categories', 'sizes', 'colors'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'brand_id'      => 'required|exists:brands,id',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'nullable|numeric',
            'price_sale'    => 'nullable|numeric',
            'status'        => 'required|boolean',
            'images.*'      => 'image|mimes:jpg,jpeg,png',
            'primary_image' => 'nullable|integer',
            'variations.*.color_id'   => 'required|exists:colors,id',
            'variations.*.size_id'    => 'required|exists:sizes,id',
            'variations.*.price'      => 'required|numeric',
            'variations.*.price_sale' => 'nullable|numeric',
            'variations.*.quantity'   => 'required|integer',
            'gender' => 'required|in:nam,nu,unisex',

        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'name'        => $request->name,
                'brand_id'    => $request->brand_id,
                'category_id' => $request->category_id,
                'price'       => $request->price,
                'price_sale'  => $request->price_sale,
                'status'      => $request->status,
                'gender' => $request->gender,
                'description' => $request->description,

            ]);

            // Cập nhật ảnh (nếu có)
            if ($request->hasFile('images')) {
                // Xoá ảnh cũ
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete($image->image_url);
                    $image->delete();
                }

                // Thêm ảnh mới
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url'  => $path,
                        'is_primary' => ($index == $request->primary_image) ? 1 : 0,
                    ]);
                }
            }

            // Cập nhật biến thể: xoá hết và thêm lại
            $product->variations()->delete();
            foreach ($request->variations as $variation) {
                ProductVariation::create([
                    'product_id'  => $product->id,
                    'color_id'    => $variation['color_id'],
                    'size_id'     => $variation['size_id'],
                    'price'       => $variation['price'],
                    'price_sale'  => $variation['price_sale'],
                    'quantity'    => $variation['quantity'],
                ]);
            }
            $product->quantity = $product->variations()->sum('quantity');
            $product->save();

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Kiểm tra sản phẩm có đang tồn tại trong giỏ hàng không
        $isInCart = Cart::where('product_id', $id)->exists();

        if ($isInCart) {
            return redirect()->route('admin.products.index')->withErrors(['error' => 'Không thể xoá sản phẩm vì đang có trong giỏ hàng của khách hàng.']);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xoá tạm sản phẩm!');
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->with(['brand', 'category', 'primaryImage'])->paginate(10);
        return view('admin.products.trash', compact('products'));
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.trash')->with('success', 'Khôi phục sản phẩm thành công!');
    }
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        // Xoá ảnh khỏi storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        $product->images()->delete();
        $product->variations()->delete();
        $product->forceDelete();

        return redirect()->route('admin.products.trash')->with('success', 'Xoá vĩnh viễn thành công!');
    }
}
