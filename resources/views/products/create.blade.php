@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Create Product</h1>

    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name"
                   class="border p-2 w-full"
                   value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block font-semibold">Description:</label>
            <textarea name="description" id="description" rows="3"
                      class="border p-2 w-full">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="base_price" class="block font-semibold">Base Price:</label>
            <input type="number" step="0.01" name="base_price" id="base_price"
                   class="border p-2 w-full"
                   value="{{ old('base_price') }}">
            @error('base_price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block font-semibold">Category (optional):</label>
            <select name="category_id" id="category_id" class="border p-2 w-full">
                <option value="">No Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Create</button>
        <a href="{{ route('products.index') }}" class="bg-gray-300 text-black px-4 py-2">Cancel</a>
    </form>
@endsection
