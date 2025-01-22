@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Categories</h1>

    <a href="{{ route('categories.create') }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">
        Create New Category
    </a>

    @if($categories->isEmpty())
        <p>No categories found.</p>
    @else
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Product Count</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">
                        {{ $category->products->count() }}
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('categories.show', $category) }}" class="text-blue-500 mr-2">View</a>
                        <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 mr-2">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">
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
@endsection
