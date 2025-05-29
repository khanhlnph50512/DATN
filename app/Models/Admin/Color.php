<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = [
        'name', 'code'
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
