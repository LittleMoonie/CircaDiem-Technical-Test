@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-2">Product Details</h1>

    <div class="bg-white rounded shadow p-4 mb-4">
        <p><strong>ID:</strong> {{ $product->id }}</p>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Base Price:</strong> {{ $product->base_price }}</p>
        <p>
            <strong>Category:</strong>
            @if($product->category)
                {{ $product->category->name }}
            @else
                N/A
            @endif
        </p>
        <p>
            <strong>Total Price (including variations):</strong>
            {{ $product->totalPrice() }}
        </p>
    </div>

    <div class="mb-4">
        <h2 class="font-semibold text-lg mb-2">Variations</h2>
        @if($product->variations->isEmpty())
            <p>No variations available.</p>
        @else
            <ul class="list-disc list-inside">
                @foreach($product->variations as $variation)
                    <li>
                        <strong>{{ $variation->value }}</strong>
                        (extra price: {{ $variation->extra_price }})
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('variations.index', $product) }}" class="inline-block bg-blue-600 text-white px-4 py-2 mt-2">
            Manage Variations
        </a>
    </div>

    <a href="{{ route('products.index') }}" class="bg-gray-300 text-black px-4 py-2">Back to Product List</a>
@endsection
