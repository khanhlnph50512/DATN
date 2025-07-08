<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
