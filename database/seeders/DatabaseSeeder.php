<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Creates 5 categories, each with 5 products, each product with 3 variations
        \App\Models\Category::factory(5)
            ->has(\App\Models\Product::factory(5)
                ->has(\App\Models\ProductVariation::factory(3)))
            ->create();
    }
}
