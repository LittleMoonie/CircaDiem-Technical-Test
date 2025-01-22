@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Products</h1>

    <form method="GET" action="{{ route('products.index') }}" class="flex items-center mb-4">
        <input name="search" placeholder="Search by name" class="border p-2 mr-2" value="{{ request('search') }}">

        <select name="category" class="border p-2 mr-2">
            <option value="">All Categories</option>
            @foreach(\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Filter</button>
    </form>

    <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">Create New Product</a>

    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Category</th>
            <th class="py-2 px-4 border-b">Base Price</th>
            <th class="py-2 px-4 border-b">Total Price</th>
            <th class="py-2 px-4 border-b">Variations</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                <td class="py-2 px-4 border-b">
                    {{ $product->category ? $product->category->name : 'N/A' }}
                </td>
                <td class="py-2 px-4 border-b">{{ $product->base_price }}</td>
                <td class="py-2 px-4 border-b">
                    {{ $product->totalPrice() }}
                </td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('variations.index', $product) }}" class="text-blue-500 underline">
                        Manage Variations ({{ $product->variations->count() }})
                    </a>
                </td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('products.show', $product) }}" class="text-blue-500 mr-2">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 mr-2">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-500"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="py-2 px-4">No products found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
