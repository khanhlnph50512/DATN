<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Size extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sizes';

    protected $fillable = ['name'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
