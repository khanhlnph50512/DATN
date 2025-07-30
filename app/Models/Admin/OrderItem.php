<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $fillable = [
        'order_id', 'product_id', 'variation_id',
        'quantity', 'price', 'discount', 'final_price',
        'product_name', 'variation_name', 'category_name', 'brand_name', 'image',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class);
}

public function variation()
{
    return $this->belongsTo(ProductVariation::class, 'variation_id');
}
}
