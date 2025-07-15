<?php

namespace App\Models\Admin;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

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
    public function products()
{
    return $this->hasMany(Product::class);
}
}
