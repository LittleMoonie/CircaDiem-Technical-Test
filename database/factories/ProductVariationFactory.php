<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariationFactory extends Factory
{
    public function definition()
    {
        return [
            'value' => $this->faker->colorName(),
            'extra_price' => $this->faker->randomFloat(2, 0, 50),
            'product_id' => Product::factory(),
        ];
    }
}
