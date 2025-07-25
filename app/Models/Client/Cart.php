<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Client\ProductVariation;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'variation_id',
        'quantity',
                'price', // Thêm dòng này

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }
}
