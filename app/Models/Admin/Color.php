<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'code'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'color_id');
    }
}
