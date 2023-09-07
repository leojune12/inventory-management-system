<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'buying_price' => fake()->randomNumber(3),
            'selling_price' => fake()->randomNumber(3),
            'category_id' => rand(1, 2500),
            'unit_id' => rand(1, 2500),
            'stock' => fake()->randomNumber(2),
        ];
    }
}
