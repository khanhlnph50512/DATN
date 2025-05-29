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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $products = Product::with(['brand', 'primaryImage'])->paginate(10);
    return view('admin.products.index', compact('products'));
}
    // Form thêm sản phẩm mới
    public function create()
    {
            $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create', compact('brands', 'sizes', 'colors','categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'primary_image_index' => 'required|integer',
            'variations' => 'array',
            'variations.*.size_id' => 'required|exists:sizes,id',
            'variations.*.color_id' => 'required|exists:colors,id',
            'variations.*.quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'price_sale' => $request->price_sale,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'status' => $request->status,
                 'category_id' => $request->category_id
            ]);

            $images = $request->file('images');
            $primaryIndex = $request->primary_image_index;

            foreach ($images as $index => $imageFile) {
                $path = $imageFile->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'is_primary' => ($index == $primaryIndex) ? 1 : 0,
                ]);
            }

            if ($request->has('variations')) {
                foreach ($request->variations as $variation) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'size_id' => $variation['size_id'],
                        'color_id' => $variation['color_id'],
                        'quantity' => $variation['quantity'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Lỗi: ' . $e->getMessage())->withInput();
        }
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['brand', 'images', 'variations.size', 'variations.color'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Form sửa sản phẩm
    public function edit($id)
{
    $product = Product::with(['images', 'variations'])->findOrFail($id);
    $brands = Brand::all();
    $sizes = Size::all();
    $colors = Color::all();
    $categories = Category::all();

    $productImages = $product->images;
    $productVariants = $product->variations;

    return view('admin.products.edit', compact('product', 'brands', 'sizes', 'colors', 'categories', 'productImages', 'productVariants'));
}


    // Cập nhật sản phẩm
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|max:255',
        'brand_id' => 'required|exists:brands,id',
        'price' => 'required|numeric',
        'price_sale' => 'nullable|numeric',
        'quantity' => 'required|integer',
        'description' => 'nullable|string',
        'status' => 'required|in:0,1',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'primary_image_index' => 'nullable|integer',
        'primary_image_id' => 'nullable|integer', // thêm validate cho primary_image_id
        'variations' => 'array',
        'variations.*.size_id' => 'required|exists:sizes,id',
        'variations.*.color_id' => 'required|exists:colors,id',
        'variations.*.quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product = Product::findOrFail($id);

    DB::beginTransaction();
    try {
        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('images')) {
            // Xóa file ảnh cũ trong storage
            foreach ($product->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_url);
            }
            // Xóa ảnh cũ trong DB
            $product->images()->delete();

            $images = $request->file('images');
            $primaryIndex = $request->primary_image_index ?? 0;

            foreach ($images as $index => $imageFile) {
                $path = $imageFile->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'is_primary' => ($index == $primaryIndex) ? 1 : 0,
                ]);
            }
        } else {
            // Nếu không upload ảnh mới, cập nhật ảnh chính dựa vào primary_image_id
            if ($request->filled('primary_image_id')) {
                $primaryImageId = $request->primary_image_id;
                // Reset tất cả ảnh thành is_primary = 0
                $product->images()->update(['is_primary' => 0]);
                // Đánh dấu ảnh được chọn là chính
                $product->images()->where('id', $primaryImageId)->update(['is_primary' => 1]);
            }
        }

        // Cập nhật biến thể: Xóa hết rồi tạo lại
        $product->variations()->delete();

        if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'size_id' => $variation['size_id'],
                    'color_id' => $variation['color_id'],
                    'quantity' => $variation['quantity'],
                ]);
            }
        }

        DB::commit();

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors('Lỗi: ' . $e->getMessage())->withInput();
    }
}


    // Xóa mềm sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();  // xóa mềm vì trong model có SoftDeletes
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }

    // Hiển thị danh sách sản phẩm đã xóa mềm (thùng rác)
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('admin.products.trash', compact('products'));
    }

    // Khôi phục sản phẩm đã xóa mềm
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('admin.products.trash')->with('success', 'Khôi phục sản phẩm thành công');
    }

    // Xóa vĩnh viễn sản phẩm
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        // Xóa ảnh, biến thể, file trong storage nếu cần

        $product->forceDelete();
        return redirect()->route('admin.products.trash')->with('success', 'Xóa vĩnh viễn sản phẩm thành công');
    }
}
