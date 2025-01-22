@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Category</h1>

    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name"
                   class="border p-2 w-full"
                   value="{{ old('name', $category->name) }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Update</button>
        <a href="{{ route('categories.index') }}" class="bg-gray-300 text-black px-4 py-2">Cancel</a>
    </form>
@endsection
