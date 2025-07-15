<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
        'user_id', 'session_id', 'order_number', 'total_amount',
        'status', 'payment_status', 'payment_method',
        'shipping_address', 'phone_number', 'note', 'email',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
