<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;
    protected $table = 'sizes';

    protected $fillable = ['name'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
