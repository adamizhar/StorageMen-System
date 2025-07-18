@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-semibold text-gray-500 mb-6">Product List</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('products.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            + Add Product
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 border-separate border-spacing-0 rounded-lg overflow-hidden">
            <thead class="bg-gray-500 text-gray-800">
                <tr>
                    <th class="py-3 px-4 border">Name</th>
                    <th class="py-3 px-4 border">PID</th>
                    <th class="py-3 px-4 border">Quantity</th>
                    <th class="py-3 px-4 border">Category</th>
                    <th class="py-3 px-4 border">Image</th>
                    <th class="py-3 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-blue-50">
                        <td class="py-2 px-4 border">{{ $product->name }}</td>
                        <td class="py-2 px-4 border">{{ $product->sku }}</td>
                        <td class="py-2 px-4 border">{{ $product->quantity }}</td>
                        <td class="py-2 px-4 border">{{ $product->category }}</td>
                        <td class="py-2 px-4 border">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="w-16 h-16 object-cover mx-auto">
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border">
                            @php
                                $role = Auth::user()->role;
                            @endphp

                            @if(in_array($role, ['admin', 'manager', 'supervisor']))
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
