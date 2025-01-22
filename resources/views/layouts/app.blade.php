<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow p-4 mb-4">
    <a href="{{ route('products.index') }}" class="mr-4 font-semibold">Products</a>
    <a href="{{ route('categories.index') }}" class="mr-4 font-semibold">Categories</a>
</nav>

<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>
