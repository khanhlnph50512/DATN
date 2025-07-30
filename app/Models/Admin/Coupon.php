<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'description', 'discount_amount', 'discount_percent',
        'minimum_order_amount', 'valid_from', 'valid_until',
        'usage_limit', 'active',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'active' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_coupons')->withPivot('used_at')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_coupons')->withTimestamps();
    }
}
