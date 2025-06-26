<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['amount', 'percent']);
        $now = now();

        return [
            'code' => strtoupper(Str::random(8)),
            'description' => $this->faker->sentence(),
            'discount_amount' => $type === 'amount' ? $this->faker->numberBetween(10000, 50000) : null,
            'discount_percent' => $type === 'percent' ? $this->faker->numberBetween(5, 30) : null,
            'minimum_order_amount' => $this->faker->numberBetween(50000, 300000),
            'valid_from' => $now,
            'valid_until' => $now->copy()->addDays(rand(7, 30)),
            'usage_limit' => $this->faker->numberBetween(10, 100),
            'active' => $this->faker->boolean(80), // 80% là còn hoạt động
        ];
    }
}
