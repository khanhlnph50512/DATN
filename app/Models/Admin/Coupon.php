<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'description',
        'discount_amount',
        'discount_percent',
        'valid_from',
        'valid_until',
        'usage_limit',
        'active',
        'minimum_order_amount'
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
