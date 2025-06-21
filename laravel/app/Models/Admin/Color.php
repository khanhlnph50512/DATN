<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    protected $table = 'colors';

    protected $fillable = [
        'name', 'code'
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
