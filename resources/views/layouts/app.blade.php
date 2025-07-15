<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        {{-- ✅ Top Navigation (Keep this) --}}
        @include('layouts.navigation')

        {{-- ✅ Page Wrapper with Sidebar and Content --}}
        <div class="flex">
            
            {{-- ✅ Left Sidebar --}}
            <aside class="w-64 bg-white dark:bg-gray-800 min-h-screen shadow-lg">
                
                <nav class="mt-4 px-4 space-y-2 text-gray-800 dark:text-gray-200">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
                    <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Products</a>
                    <a href="{{ route('transactions.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Transactions</a>
                    <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Users</a>
                    <a href="{{ route('audit.logs') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Audit Logs</a>
                </nav>
            </aside>

            {{-- ✅ Page Content --}}
            <div class="flex-1">
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
