<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1000),
            'photo_path' => 'images/0IBvyXhjQtQYfqzYFCUBp4Hv3acwiP21Vs5yh9Wq.png',
            'user_id' => 1,
        ];
    }
}
