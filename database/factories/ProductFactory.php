<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Color;
use App\Models\Admin\Size;
use App\Models\Admin\ProductVariation;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'brand_id' => Brand::inRandomOrder()->first()?->id ?? 1,
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'price_sale' => null,
            'status' => 1,
            'quantity' => $this->faker->numberBetween(10, 100),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $colors = Color::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $sizes = Size::inRandomOrder()->take(rand(1, 3))->pluck('id');

            foreach ($colors as $colorId) {
                foreach ($sizes as $sizeId) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                        'quantity' => rand(1, 20),
                    ]);
                }
            }
        });
    }
}
