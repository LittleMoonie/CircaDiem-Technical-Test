<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function index(Product $product)
    {
        $variations = $product->variations;
        return view('variations.index', compact('product', 'variations'));
    }

    public function create(Product $product)
    {
        return view('variations.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'value' => 'required',
            'extra_price' => 'nullable|numeric'
        ]);

        $validated['extra_price'] = $validated['extra_price'] ?? 0;
        $product->variations()->create($validated);

        return redirect()->route('variations.index', $product)->with('success', 'Variation created successfully');
    }

    public function edit(Product $product, ProductVariation $variation)
    {
        return view('variations.edit', compact('product', 'variation'));
    }

    public function update(Request $request, Product $product, ProductVariation $variation)
    {
        $validated = $request->validate([
            'value' => 'required',
            'extra_price' => 'nullable|numeric'
        ]);

        $variation->update($validated);
        return redirect()->route('variations.index', $product)->with('success', 'Variation updated successfully');
    }

    public function destroy(Product $product, ProductVariation $variation)
    {
        $variation->delete();
        return redirect()->route('variations.index', $product)->with('success', 'Variation deleted successfully');
    }
}
