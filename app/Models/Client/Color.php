<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name', 'code'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
