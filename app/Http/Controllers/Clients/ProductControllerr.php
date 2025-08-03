<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('primaryImage')
            ->where('status', 1);

        if ($request->has('gender')) {
            $gender = $request->input('gender');

            if (in_array($gender, ['nam', 'nu', 'unisex'])) {
                $query->where('gender', $gender);
            }
        }
        if ($request->has('sale') && $request->sale == 1) {
            $query->whereNotNull('price_sale')
                ->whereColumn('price_sale', '<', 'price');
        }

        $products = $query->orderByDesc('id')->paginate(12);

        return view('client.products.listProducts', compact('products'));
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
            'reviews' => function ($q) {
                $q->where('status', 'approved')->latest();
            },
            'reviews.user'
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

    public function search(Request $request)
    {
        $key = $request->input('key');

        $products = Product::where('name', 'like', "%{$key}%")
            ->orWhere('description', 'like', "%{$key}%")
            ->paginate(12);

        return view('client.products.listProducts', compact('products', 'key',));
    }
}
