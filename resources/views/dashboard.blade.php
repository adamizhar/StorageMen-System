@auth
    @if(Auth::user()->role === 'admin')

        @extends('layouts.app')

        @section('content')
        <div class="max-w-6xl mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold text-gray-500 mb-6">Admin Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
                    <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                    <p class="text-3xl text-blue-700">{{ $totalProducts }}</p>
                </div></br>

                <div class="bg-white p-6 rounded shadow border-l-4 border-red-500">
                    <h3 class="text-lg font-semibold text-gray-700">Low Stock Alerts</h3>
                    <p class="text-3xl text-red-600">{{ $lowStockCount }}</p>
                </div></br>

                <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
                    <h3 class="text-lg font-semibold text-gray-700">Today's Transactions</h3>
                    <p class="text-3xl text-green-600">{{ $todayTransactionCount }}</p>
                </div></br>
            </div>
        </div>
        @endsection
    @endif
@endauth