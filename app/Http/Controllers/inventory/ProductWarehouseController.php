<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inventory\ProductWarehouse;
use App\Models\inventory\Product;
use App\Models\inventory\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $product_warehouses = ProductWarehouse::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_product_warehouse'], '');
        return view('inventory.product_warehouse.index', ['product_warehouses' => $product_warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $products = Product::all();
        $warehouses = Warehouse::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_product_warehouse'], '');
        return view('inventory.product_warehouse.create', compact('products', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'product_id' => 'required|unique:product_warehouses,product_id,NULL,id,warehouse_id,' . $request->warehouse_id,
            'warehouse_id' => 'required',
        ]);

        $product_warehouse = new ProductWarehouse();
        $product_warehouse->product_id = $request->product_id;
        $product_warehouse->warehouse_id = $request->warehouse_id;
        $product_warehouse->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_product_warehouse'], 'product_warehouse_id: ' . $product_warehouse->id);
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
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $product_warehouse = ProductWarehouse::find($id);
        $products = Product::all();
        $warehouses = Warehouse::all();

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_product_warehouse'], 'product_warehouse_id: ' . $id);
        return view('inventory.product_warehouse.edit', compact('product_warehouse', 'products', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'product_id' => 'required|unique:product_warehouses,product_id,' . $id . ',id,warehouse_id,' . $request->warehouse_id,
            'warehouse_id' => 'required',
        ]);

        $product_warehouse = ProductWarehouse::find($id);
        $product_warehouse->product_id = $request->product_id;
        $product_warehouse->warehouse_id = $request->warehouse_id;
        $product_warehouse->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_product_warehouse'], 'product_warehouse_id: ' . $id);
        return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
    function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-WAREHOUSE/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_product_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $product_warehouse = ProductWarehouse::find($id);
        if($product_warehouse->status==0){
            $product_warehouse->status = 1;
            $product_warehouse->save();
            $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_product_warehouse'], 'product_warehouse_id: ' . $id);
            return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega activado con éxito');
        }
        $product_warehouse->status = 0;
        $product_warehouse->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_product_warehouse'], 'product_warehouse_id: ' . $id);
        return redirect()->route('product_warehouse.index')->with('success', 'Producto en Bodega eliminado con éxito');   
    }
    
}
