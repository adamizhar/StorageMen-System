<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    $query = Transaction::with('product', 'user');

    //Filter by current user (if not admin)
    if (Auth::user()->role !== 'admin') {
        $query->where('user_id', Auth::id());
    }

    // Filtering logic
    if ($request->filled('product')) {
    $query->whereHas('product', function ($q) use ($request) {
        $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->product) . '%']);
    });
}


    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('date_from')) {
        $query->whereDate('date', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('date', '<=', $request->date_to);
    }

    $transactions = $query->latest()->get();
    $products = Product::all(); // optional: for dropdown

    return view('transactions.index', compact('transactions', 'products'));
}

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:stock-in,stock-out',
            'quantity'   => 'required|numeric|min:1',
            'date'       => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Update stock
        if ($request->type === 'stock-in') {
            $product->quantity += $request->quantity;
        } else {
            if ($product->quantity < $request->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock.']);
            }
            $product->quantity -= $request->quantity;
        }
        $product->save();

        // Save transaction
        Transaction::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'type'       => $request->type,
            'quantity'   => $request->quantity,
            'date'       => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded.');
    }
}
