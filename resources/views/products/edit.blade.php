@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-xl">
    <h2 class="text-2xl font-bold text-gray-500 mb-6">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium">Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">SKU:</label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('sku') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Quantity:</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('quantity') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Category:</label>
            <input type="text" name="category" value="{{ old('category', $product->category) }}"
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('category') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Image:</label>
            <input type="file" name="image" class="w-full">
            @if($product->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image_path) }}" width="80" class="rounded shadow" />
                </div>
            @endif
            @error('image') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="pt-4 flex gap-3">
            <button type="submit"
                style="background-color: #16a34a; color: white;"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                Update
            </button>
            <a href="{{ route('products.index') }}"
               style="background-color: #f80828ff; color: white;"
               class="bg-gray-300 text-gray-500 px-4 py-2 rounded hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
