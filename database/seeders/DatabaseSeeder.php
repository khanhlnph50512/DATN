<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\Blog;
use App\Models\Coupon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo các dữ liệu nền trước
        // Category::factory()->count(5)->create();
        // Brand::factory()->count(5)->create();
        // Color::factory()->count(5)->create();
        // Size::factory()->count(5)->create();

        // 2. Sau đó mới đến Product vì cần có category, brand, color, size
        Product::factory()->count(20)->create();

        // 3. Các bảng khác
        // Coupon::factory()->count(10)->create();
        // Blog::factory()->count(10)->create();
        // User::factory(10)->create();
        // Customer::factory(10)->create();
    }
}
