<?php

namespace App\Models\Client;

use App\Models\Admin\Order;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'rating',
        'review',
        'status',
    ];

    // Mối quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
{
    return $this->belongsTo(Order::class);
}
}
