<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'percentage' => fake()->randomFloat(2, 5, 50),
            'active' => true,
            'expired_at' => fake()->optional()->dateTimeBetween('now', '+1 month'),

        ];
    }

    public function expired(): self
    {
        return $this->state(fn (array $attributes) => [
            'expired_at' => fake()->dateTimeBetween('-1 month', '-1 day'),
        ]);
    }

    public function inactive(): self
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }
}
