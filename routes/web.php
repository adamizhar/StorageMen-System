<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\Product;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store']);
    Route::resource('users', UserController::class)->only(['index']);
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::get('/audit-logs', [AuditLogController::class, 'index'])
    ->middleware('auth')
    ->name('audit.logs');
});

Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $lowStockCount = Product::where('quantity', '<', 10)->count();
    $todayTransactionCount = Transaction::whereDate('created_at', today())->count();

    return view('dashboard', compact('totalProducts', 'lowStockCount', 'todayTransactionCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
