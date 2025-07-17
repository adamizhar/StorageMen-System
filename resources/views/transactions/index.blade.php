@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4">

    <h2 class="text-2xl font-bold text-gray-500 mb-4">Transaction History</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('transactions.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-100 p-4 rounded">
            <input type="text" name="product" placeholder="Search product name"
            value="{{ request('product') }}"
            class="border rounded p-2 w-full" />

        <select name="type" class="border rounded p-2 w-full">
            <option value="">All Types</option>
            <option value="stock-in" {{ request('type') == 'stock-in' ? 'selected' : '' }}>Stock In</option>
            <option value="stock-out" {{ request('type') == 'stock-out' ? 'selected' : '' }}>Stock Out</option>
        </select>

        <input type="date" name="date_from" value="{{ request('date_from') }}"
               class="border rounded p-2 w-full" placeholder="From date" />

        <input type="date" name="date_to" value="{{ request('date_to') }}"
               class="border rounded p-2 w-full" placeholder="To date" />

        <div class="col-span-1 md:col-span-4 text-right">
            <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
            <a href="{{ route('transactions.index') }}" class="ml-2 text-sm text-gray-600 underline">Reset</a>
        </div>
        
    </form>

    <!-- PDF -->
    <a href="{{ route('transactions.downloadPdf') }}"
    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
    Download PDF
    </a></br>
        
    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-sm text-left text-gray-700 border border-gray-300">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">Product</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                    <tr class="hover:bg-blue-50">
                        <td class="px-4 py-2 border">{{ $t->product->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border capitalize text-blue-700">{{ $t->type }}</td>
                        <td class="px-4 py-2 border">{{ $t->quantity }}</td>
                        <td class="px-4 py-2 border">{{ $t->date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 p-4">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
