<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
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
