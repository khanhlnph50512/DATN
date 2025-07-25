<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
        use SoftDeletes;

     protected $fillable = [
    'user_id', 'session_id', 'order_number', 'total_amount',
    'status', 'payment_status', 'payment_method',
    'shipping_address', 'phone_number', 'note', 'email',
    'shipping_method_id', // thêm dòng này
];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function shippingMethod()
{
    return $this->belongsTo(ShippingMethod::class);
}
}
