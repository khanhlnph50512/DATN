<?php

namespace App\Models\Admin;

use App\Models\Client\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'description',
        'gender',
        'price',
        'price_sale',
        'status',
        'quantity',

    ];

    protected $dates = ['deleted_at'];

    // Quan hệ với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với hình ảnh sản phẩm
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', 1);
    }

    // Quan hệ với các biến thể (mỗi biến thể chứa color_id và size_id)
    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }
    // Quan hệ với mã giảm giá (qua bảng trung gian product_coupons)
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'product_coupons');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
}
