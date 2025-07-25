<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingMethod extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'description'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
