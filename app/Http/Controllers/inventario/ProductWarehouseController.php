<?php

namespace App\Http\Controllers\inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product_warehouse;
use App\Models\Product;
use App\Models\Warehouse;


class ProductWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_warehouses = product_warehouse::all();
        return view('inventory.product_warehouse.index', ['product_warehouses' => $product_warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
    
        return view('inventory.product_warehouse.create', compact('products', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required',
            'product_id' => 'required',
            'warehouse_id' => 'required',
        ]);

        $product_warehouse = new product_warehouse();
        $product_warehouse->cantidad = $request->cantidad;
        $product_warehouse->product_id = $request->product_id;
        $product_warehouse->warehouse_id = $request->warehouse_id;
        $product_warehouse->save();

        return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_warehouse = product_warehouse::find($id);
        $products = Product::all();
        $warehouses = Warehouse::all();
        
        return view('inventory.product_warehouse.edit', compact('product_warehouse', 'products', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cantidad' => 'required',
            'product_id' => 'required',
            'warehouse_id' => 'required',
        ]);

        $product_warehouse = product_warehouse::find($id);
        $product_warehouse->cantidad = $request->cantidad;
        $product_warehouse->product_id = $request->product_id;
        $product_warehouse->warehouse_id = $request->warehouse_id;
        $product_warehouse->save();

        return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_warehouse = product_warehouse::find($id);
        $product_warehouse->status = 0;
        $product_warehouse->save();
        return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega eliminado con éxito');
    }
}
