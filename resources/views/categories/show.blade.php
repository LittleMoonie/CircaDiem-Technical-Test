@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Category Details</h1>

    <div class="bg-white rounded shadow p-4 mb-4">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Product Count:</strong> {{ $category->products->count() }}</p>
    </div>

    @if($category->products->isNotEmpty())
        <h2 class="font-semibold text-lg mb-2">Products in this Category:</h2>
        <ul class="list-disc list-inside mb-4">
            @foreach($category->products as $product)
                <li>{{ $product->name }} (ID: {{ $product->id }})</li>
            @endforeach
        </ul>
    @else
        <p>No products in this category.</p>
    @endif

    <a href="{{ route('categories.index') }}" class="bg-gray-300 text-black px-4 py-2">Back to Category List</a>
@endsection
