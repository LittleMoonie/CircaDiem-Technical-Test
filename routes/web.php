<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VariationController;

Route::resource('products', ProductController::class);

// For variations as nested resource under products
Route::prefix('products/{product}')->group(function () {
    Route::get('variations', [VariationController::class, 'index'])->name('variations.index');
    Route::get('variations/create', [VariationController::class, 'create'])->name('variations.create');
    Route::post('variations', [VariationController::class, 'store'])->name('variations.store');
    Route::get('variations/{variation}/edit', [VariationController::class, 'edit'])->name('variations.edit');
    Route::put('variations/{variation}', [VariationController::class, 'update'])->name('variations.update');
    Route::delete('variations/{variation}', [VariationController::class, 'destroy'])->name('variations.destroy');
});


Route::resource('categories', CategoryController::class);

// Home route can redirect to products.index
Route::get('/', function () {
    return redirect()->route('products.index');
});

