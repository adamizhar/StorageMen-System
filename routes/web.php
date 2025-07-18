<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\Transaction;
use Spatie\Permission\Models\Role;

// Public route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (authenticated)
Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $lowStockCount = Product::where('quantity', '<', 10)->count();
    $todayTransactionCount = Transaction::whereDate('created_at', today())->count();

    return view('dashboard', compact('totalProducts', 'lowStockCount', 'todayTransactionCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::get('/roles/{role}', [RoleController::class, 'edit']);

    // ─── Product CRUD (View & Create - For All Authenticated Users) ─────────────
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // ─── Transaction Basic ──────────────────────────
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/download/pdf', [TransactionController::class, 'downloadPdf'])->name('transactions.downloadPdf');

    // ─── Users (Admin Only) ───────────────────────────
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

    // ─── Audit Logs ──────────────────────────────────    
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');

    // ─── Profile Management ──────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ─── RESTRICTED: Edit, Update, Delete Products ────────────────
    Route::middleware(['role:admin|manager|supervisor'])->group(function () {
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});


require __DIR__.'/auth.php';
