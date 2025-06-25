<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'description',
        'price',
        'price_sale',
        'status',
        'quantity'
    ];
    protected $dates = ['deleted_at'];

    // Quan hệ với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Quan hệ với ProductImages
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', 1);
    }
    // Quan hệ với ProductVariation
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'product_coupons');
    }
}
