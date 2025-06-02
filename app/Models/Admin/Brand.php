<?php

namespace App\Models\Admin;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name', 'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
