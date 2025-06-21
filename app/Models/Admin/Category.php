<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories'; // Tên bảng trong database

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    // Tự động tạo slug nếu bạn muốn xử lý trong model (không bắt buộc)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
