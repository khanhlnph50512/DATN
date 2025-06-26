<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer; // ✅ import model

class CustomerFactory extends Factory
{
    protected $model = Customer::class; // ✅ gán model rõ ràng

    public function definition(): array
    {
        return [
            'seri_customer' => 'su25_anatats#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
