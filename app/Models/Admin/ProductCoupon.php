<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCoupon extends Pivot
{
    protected $table = 'product_coupons';

    protected $fillable = ['product_id', 'coupon_id'];
}
