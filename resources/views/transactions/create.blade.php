@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Transaction</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <!-- Product Selection -->
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
            <select name="product_id" id="product_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select Product --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (SKU: {{ $product->sku }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Transaction Type</label>
            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select Type --</option>
                <option value="stock-in" {{ old('type') == 'stock-in' ? 'selected' : '' }}>Stock-In</option>
                <option value="stock-out" {{ old('type') == 'stock-out' ? 'selected' : '' }}>Stock-Out</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                   class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" min="1">
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Transaction Date</label>
            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                   class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <a href="{{ route('transactions.index') }}" class="mr-4 text-gray-600 hover:underline">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
        </div>
    </form>
</div>
@endsection
