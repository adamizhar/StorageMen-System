<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Auth;// Helper auto-loaded: log_action() is available globally if autoloaded properly

// Helper auto-loaded: log_action() is available globally if autoloaded properly


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(StoreProductRequest $request)
    
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        $product = Product::create($data);
        log_action('Created Product', 'ID: ' . $product->id . ', Name: ' . $product->name);
        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, Product $product)
    public function update(StoreProductRequest $request, Product $product)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);
    log_action('Updated Product', 'ID: ' . $product->id . ', Name: ' . $product->name);
    return redirect()->route('products.index')->with('success', 'Product updated!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productId = $product->id;
        $productName = $product->name;
        $product->delete(); // soft delete
        log_action('Deleted Product', 'ID: ' . $productId . ', Name: ' . $productName);
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
