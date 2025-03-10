<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => $this->faker->word(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph(),
            'price' => rand(10, 999),
        ];
    }
}
