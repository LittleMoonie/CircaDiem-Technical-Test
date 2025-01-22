<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;

class ManageProductsCommand extends Command
{
    protected $signature = 'manage:products
                            {action : The action to perform (list|create|update|delete)}
                            {id? : The ID of the product (required for update/delete)}';

    protected $description = 'Manage Products (CRUD) via Artisan command';

    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listProducts();
                break;
            case 'create':
                $this->createProduct();
                break;
            case 'update':
                $this->updateProduct();
                break;
            case 'delete':
                $this->deleteProduct();
                break;
            default:
                $this->error("Invalid action. Use list|create|update|delete.");
        }

        return 0;
    }

    private function listProducts()
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            $this->info("No products found.");
            return;
        }

        foreach ($products as $product) {
            $this->line("ID: {$product->id} | Name: {$product->name} | Base Price: {$product->base_price} | Category: " . ($product->category->name ?? 'N/A'));
        }
    }

    private function createProduct()
    {
        // You can prompt the user to input details
        $name = $this->ask('Enter product name');
        $description = $this->ask('Enter product description');
        $basePrice = $this->ask('Enter base price');
        $categoryId = $this->ask('Enter category id (or press enter to skip)');

        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'base_price' => $basePrice,
            'category_id' => $categoryId ?: null,
        ]);

        $this->info("Product [{$product->name}] created successfully with ID {$product->id}!");
    }

    private function updateProduct()
    {
        $id = $this->argument('id');
        $product = Product::find($id);

        if (!$product) {
            $this->error("Product with ID $id not found.");
            return;
        }

        $name = $this->ask('Enter new product name (leave blank to keep current)', $product->name);
        $description = $this->ask('Enter new product description (leave blank to keep current)', $product->description);
        $basePrice = $this->ask('Enter new base price (leave blank to keep current)', $product->base_price);
        $categoryId = $this->ask('Enter new category id (leave blank to keep current)', $product->category_id);

        $product->update([
            'name' => $name,
            'description' => $description,
            'base_price' => $basePrice,
            'category_id' => $categoryId ?: null,
        ]);

        $this->info("Product [{$product->id}] updated successfully!");
    }

    private function deleteProduct()
    {
        $id = $this->argument('id');
        $product = Product::find($id);

        if (!$product) {
            $this->error("Product with ID $id not found.");
            return;
        }

        $product->delete();
        $this->info("Product [{$id}] deleted successfully!");
    }
}
