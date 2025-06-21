<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Number;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'seri_user' => 'su25_anatats#' . mt_rand(0, 999999), // Mã người dùng riêng
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // mật khẩu mặc định
            'avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'birthday' => $this->faker->date('Y-m-d'),
            'role' => $this->faker->randomElement(['admin', 'customers']), // role
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
