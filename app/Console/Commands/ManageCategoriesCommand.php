<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class ManageCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:categories
                            {action : The action to perform (list|create|update|delete)}
                            {id? : The ID of the category (required for update/delete)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage Categories (CRUD) via Artisan command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listCategories();
                break;
            case 'create':
                $this->createCategory();
                break;
            case 'update':
                $this->updateCategory();
                break;
            case 'delete':
                $this->deleteCategory();
                break;
            default:
                $this->error('Invalid action. Use list|create|update|delete.');
        }

        return 0;
    }

    /**
     * List all categories.
     */
    private function listCategories()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->info("No categories found.");
            return;
        }

        $this->info("List of all categories:");
        foreach ($categories as $category) {
            $this->line("ID: {$category->id}, Name: {$category->name}");
        }
    }

    /**
     * Create a new category (prompt user for name).
     */
    private function createCategory()
    {
        $name = $this->ask('Enter category name');

        // If user cancels or leaves it empty, handle gracefully
        if (!$name) {
            $this->error('Category name cannot be empty.');
            return;
        }

        $category = Category::create([
            'name' => $name
        ]);

        $this->info("Category [{$category->name}] created successfully with ID {$category->id}!");
    }

    /**
     * Update an existing category by ID.
     */
    private function updateCategory()
    {
        $id = $this->argument('id');

        if (!$id) {
            $this->error("You must specify the category ID for 'update' action.");
            return;
        }

        $category = Category::find($id);

        if (!$category) {
            $this->error("Category with ID $id not found.");
            return;
        }

        $name = $this->ask('Enter new category name (leave blank to keep current)', $category->name);

        if (!$name) {
            $this->error('Category name cannot be empty.');
            return;
        }

        $category->update(['name' => $name]);

        $this->info("Category [{$category->id}] updated successfully!");
    }

    /**
     * Delete a category by ID.
     */
    private function deleteCategory()
    {
        $id = $this->argument('id');

        if (!$id) {
            $this->error("You must specify the category ID for 'delete' action.");
            return;
        }

        $category = Category::find($id);

        if (!$category) {
            $this->error("Category with ID $id not found.");
            return;
        }

        $name = $category->name;
        $category->delete();

        $this->info("Category [{$name}] with ID [{$id}] deleted successfully!");
    }
}
