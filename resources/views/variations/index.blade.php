@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">
        Variations for Product: {{ $product->name }}
    </h1>

    <a href="{{ route('variations.create', $product) }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">
        Create New Variation
    </a>

    @if($variations->isEmpty())
        <p>No variations found for this product.</p>
    @else
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Value</th>
                <th class="py-2 px-4 border-b">Extra Price</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($variations as $variation)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $variation->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $variation->value }}</td>
                    <td class="py-2 px-4 border-b">{{ $variation->extra_price }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('variations.edit', [$product, $variation]) }}" class="text-yellow-500 mr-2">
                            Edit
                        </a>
                        <form action="{{ route('variations.destroy', [$product, $variation]) }}" method="POST"
                              class="inline-block">
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
            @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('products.show', $product) }}" class="bg-gray-300 text-black px-4 py-2 mt-4 inline-block">
        Back to Product
    </a>
@endsection
