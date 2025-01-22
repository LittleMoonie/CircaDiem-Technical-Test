<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Console\Command;

class ManageVariationsCommand extends Command
{
    protected $signature = 'manage:variations
                            {action : The action to perform (list|create|update|delete)}
                            {id? : The ID of the variation (required for update/delete)}
                            {--product_id= : The ID of the product (for listing by product or creating a variation)}';

    protected $description = 'Manage Product Variations (CRUD) via Artisan command';

    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listVariations();
                break;
            case 'create':
                $this->createVariation();
                break;
            case 'update':
                $this->updateVariation();
                break;
            case 'delete':
                $this->deleteVariation();
                break;
            default:
                $this->error("Invalid action. Use list|create|update|delete.");
        }

        return 0;
    }

    private function listVariations()
    {
        $productId = $this->option('product_id');

        if ($productId) {
            $product = Product::find($productId);
            if (!$product) {
                $this->error("Product with ID $productId not found.");
                return;
            }
            $variations = $product->variations;
            $this->info("Listing variations for Product ID {$productId}:");
        } else {
            $variations = ProductVariation::all();
            $this->info("Listing all variations:");
        }

        if ($variations->isEmpty()) {
            $this->info("No variations found.");
            return;
        }

        foreach ($variations as $variation) {
            $this->line(
                "ID: {$variation->id}, Product ID: {$variation->product_id}, "
                ."Value: {$variation->value}, Extra Price: {$variation->extra_price}"
            );
        }
    }

    private function createVariation()
    {
        $productId = $this->option('product_id') ?: $this->ask('Enter product ID');

        $product = Product::find($productId);
        if (!$product) {
            $this->error("Product with ID $productId not found.");
            return;
        }

        $value = $this->ask('Enter variation value (e.g., "XL" or "Rouge")');
        $extraPrice = $this->ask('Enter extra price (default 0)', 0);

        $variation = ProductVariation::create([
            'product_id' => $productId,
            'value' => $value,
            'extra_price' => $extraPrice,
        ]);

        $this->info("Variation [ID: {$variation->id}] created successfully for Product [ID: $productId]!");
    }

    private function updateVariation()
    {
        $id = $this->argument('id');
        $variation = ProductVariation::find($id);

        if (!$variation) {
            $this->error("Variation with ID $id not found.");
            return;
        }

        $value = $this->ask('Enter new variation value (leave blank to keep current)', $variation->value);
        $extraPrice = $this->ask('Enter new extra price (leave blank to keep current)', $variation->extra_price);

        $variation->update([
            'value' => $value,
            'extra_price' => $extraPrice,
        ]);

        $this->info("Variation [ID: $id] updated successfully!");
    }

    private function deleteVariation()
    {
        $id = $this->argument('id');
        $variation = ProductVariation::find($id);

        if (!$variation) {
            $this->error("Variation with ID $id not found.");
            return;
        }

        $variation->delete();
        $this->info("Variation [ID: $id] deleted successfully!");
    }
}
