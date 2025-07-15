<?php

namespace App\Models\Client;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
 protected $fillable = [
        'user_id', 'product_id', 'content', 'rating', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Admin\Product::class);
    }}
