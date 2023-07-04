<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class product_controller extends Controller
{

    /**
     * Display a listing of the resource.
     * index function is used to display the product page
     * store function is used to store the data in the database
     * update function is used to update the data in the database
     * destroy function is used to delete the data from the database
     * edit function is used to edit the data in the database
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('inventory.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('inventory.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('inventory.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('inventory.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required|exists:categories,id',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        return redirect()->back()->with('success', 'Producto eliminado con éxito');
    }
}
