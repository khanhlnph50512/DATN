<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::table('shipping_methods')->insert([
            [
                'name' => 'Giao hàng tiêu chuẩn',
                'price' => 0,
                'description' => 'Miễn phí 3-5 ngày làm việc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giao hàng nhanh',
                'price' => 20000,
                'description' => 'Giao hàng 1-2 ngày làm việc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giao hàng hỏa tốc',
                'price' => 50000,
                'description' => 'Giao hàng trong ngày (áp dụng nội thành)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
