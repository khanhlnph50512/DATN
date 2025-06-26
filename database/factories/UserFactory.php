<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User; // ✅ Đảm bảo đúng namespace model User

class UserFactory extends Factory
{
    protected $model = User::class; // ✅ Khai báo model gốc (nếu model không đúng mặc định)

    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'seri_user' => 'su25_anatats#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT), // đẹp hơn
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'birthday' => $this->faker->date('Y-m-d'),
            'role' => $this->faker->randomElement(['admin', 'customers']),
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
