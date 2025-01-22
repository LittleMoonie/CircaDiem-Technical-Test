<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_has_variations()
    {
        $product = Product::factory()->create();
        $variation = ProductVariation::factory()->create(['product_id' => $product->id]);

        $this->assertEquals(1, $product->variations->count());
        $this->assertTrue($product->variations->contains($variation));
    }

    /** @test */
    public function it_calculates_total_price()
    {
        $product = Product::factory()->create(['base_price' => 100]);
        ProductVariation::factory()->create(['product_id' => $product->id, 'extra_price' => 10]);
        ProductVariation::factory()->create(['product_id' => $product->id, 'extra_price' => 5]);

        $this->assertEquals(115, $product->totalPrice());
    }
}
