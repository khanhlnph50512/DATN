<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCoupon extends Pivot
{
    protected $table = 'user_coupons';

    protected $fillable = ['user_id', 'coupon_id', 'used_at'];
}
