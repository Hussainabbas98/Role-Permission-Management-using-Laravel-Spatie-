<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
      public function __construct()
    {
        // examples:
        $this->middleware(['permission:product-create|product-edit|product-delete'], ["only" => "index", "show"]);
        $this->middleware(['permission:product-create'], ["only" => "create", "store"]);
        $this->middleware(['permission:product-edit'], ["only" => "edit", "update"]);
        $this->middleware(['permission:product-delete'], ["only" => "destory"]);
    }
    public function index()
    {
        //
        $products = Product::all();
        return view('product.index', compact('products'));

        // dd("$users");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Create a new product
        Product::create([
            'name' => $request->name,
        ]); 
        // Redirect to the product index with a success message
        return redirect()->route("products.index")->with('success', 'Product created successfully.');
        
  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $products = Product::find($id);
        return view('product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $products = Product::find($id);
        return view('product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->save();
        // Redirect to the product index with a success message
        return redirect()->route("products.index")->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route("products.index")->with('success', 'Product deleted successfully.');
        }
        return redirect()->route("products.index")->with('error', 'Product not found.');
    }
}
