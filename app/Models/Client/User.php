<?php

namespace App\Models\Client;

use App\Models\Client\Wishlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{

    use HasFactory, Notifiable;

    protected $table = 'users'; // dùng chung bảng users
    protected $fillable = ['seri_user', 'name', 'email', 'password'];

    public function wishlist()
{
    return $this->belongsToMany(\App\Models\Client\Product::class, 'wishlists', 'user_id', 'product_id')->withTimestamps();
}
}
