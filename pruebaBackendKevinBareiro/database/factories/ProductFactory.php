<?php

namespace Database\Factories;

use App\Models\Currency;
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
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(10),
            'price' => fake()->randomFloat(2, 10, 1000),
            'currency_id' => Currency::first()?->id ?? Currency::factory(),
            'tax_cost' => fake()->randomFloat(2, 1, 100),
            'manufacturing_cost' => fake()->randomFloat(2, 5, 500),
        ];
    }
}
