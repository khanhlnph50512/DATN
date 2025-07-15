<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('primaryImage')  // eager load ảnh đại diện
                        ->where('status', 1)
                        ->orderByDesc('id')
                        ->paginate(12);
        return view('client.products.listProducts',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $slug, $id)
{
    $product = Product::with([
        'primaryImage',
        'images',
        'variations.color',
        'variations.size',
        'comments' => function ($query) {
            $query->where('status', 'approved')->latest();
        },
        'comments.user', // Load người bình luận
    ])->findOrFail($id);

    // Kiểm tra slug hợp lệ, nếu không thì redirect
    $trueSlug = Str::slug($product->name);
    if ($slug !== $trueSlug) {
        return redirect()->route('client.products.detailProducts', [
            'slug' => $trueSlug,
            'id' => $product->id,
        ]);
    }

    return view('client.products.detailProducts', compact('product'));
}

    /**
     * Show the form for editing the specified resource.
     */

}
