<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable = ['name'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
