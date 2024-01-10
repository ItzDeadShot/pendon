<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->text(),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'proof' => 'images/0IBvyXhjQtQYfqzYFCUBp4Hv3acwiP21Vs5yh9Wq.png',
            'user_id' => fake()->numberBetween(1, 7),
            'item_id' => fake()->numberBetween(1, 3),
        ];
    }
}
