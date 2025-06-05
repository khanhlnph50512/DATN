<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'seri_customer' => 'CUS' . strtoupper(Str::random(6)),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'birthday' => $this->faker->date('Y-m-d'),
            'remember_token' => Str::random(10),
        ];
    }
}
