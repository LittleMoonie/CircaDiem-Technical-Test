<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->productName(), // Or 'word()' if no productName
            'description' => $this->faker->sentence(),
            'base_price' => $this->faker->randomFloat(2, 5, 500),
            'category_id' => Category::factory() // if using one-to-many
        ];
    }
}
