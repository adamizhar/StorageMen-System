@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-xl">
    <h2 class="text-2xl font-bold text-gray-500 mb-6">Add Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 text-gray-800" />
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">SKU:</label>
            <input type="text" name="sku" value="{{ old('sku') }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 text-gray-800" />
            @error('sku') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Quantity:</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 text-gray-800" />
            @error('quantity') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Category:</label>
            <input type="text" name="category" value="{{ old('category') }}"
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 text-gray-800" />
            @error('category') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Image (optional):</label>
            <input type="file" name="image"
                   class="w-full text-gray-800 border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
            @error('image') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="pt-4 flex gap-3">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Save
            </button>
            <a href="{{ route('products.index') }}"
               class="bg-gray-300 text-gray-500 px-4 py-2 rounded hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
