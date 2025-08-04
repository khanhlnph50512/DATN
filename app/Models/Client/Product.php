<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Client\ProductVariation;
use App\Models\Client\ProductImage;
use App\Models\Client\Cart;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'price',
        'price_sale',
        'status',
        'quantity'
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
   public function reviews()
{
    return $this->hasMany(\App\Models\Client\Review::class, 'product_id', 'id');
}
public function likedUsers()
{
    return $this->belongsToMany(\App\Models\Client\User::class, 'wishlists', 'product_id', 'user_id')->withTimestamps();
}
}
