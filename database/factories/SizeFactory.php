<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\Size;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition(): array
    {
        return [
            'name' => strtoupper($this->faker->randomElement(['39','40','41','42','43'])),
        ];
    }
}
