<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seri_customer',
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'address',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
