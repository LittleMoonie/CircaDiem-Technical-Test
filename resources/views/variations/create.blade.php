@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">
        Create Variation for Product: {{ $product->name }}
    </h1>

    <form action="{{ route('variations.store', $product) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="value" class="block font-semibold">Variation Value (e.g., "XL" or "Rouge"):</label>
            <input type="text" name="value" id="value"
                   class="border p-2 w-full"
                   value="{{ old('value') }}">
            @error('value')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="extra_price" class="block font-semibold">Extra Price (optional):</label>
            <input type="number" step="0.01" name="extra_price" id="extra_price"
                   class="border p-2 w-full"
                   value="{{ old('extra_price', 0) }}">
            @error('extra_price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Create</button>
        <a href="{{ route('variations.index', $product) }}" class="bg-gray-300 text-black px-4 py-2">Cancel</a>
    </form>
@endsection
