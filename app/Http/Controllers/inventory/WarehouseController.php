<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\inventory\Warehouse;
use Illuminate\Http\Request;
use App\Models\inventory\ProductWarehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * index function is used to display the warehouse page
     * store function is used to store the data in the database
     * update function is used to update the data in the database
     * destroy function is used to delete the data from the database
     * edit function is used to edit the data in the database
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $warehouses = Warehouse::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_warehouse'], '');
        return view('inventory.warehouse.index', ['warehouses' => $warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_warehouse'], '');
        return view('inventory.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_warehouse'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required | unique:warehouses|max:50',
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_warehouse'], 'warehouse_id: ' . $warehouse->id);
        return redirect()->route('warehouse.index')->with('success', 'Bodega creada con éxito');
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
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_warehouse'], 'warehouse_id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $warehouse = Warehouse::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_warehouse'], 'warehouse_id: ' . $id);
        return view('inventory.warehouse.edit', ['warehouse' => $warehouse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_warehouse'], 'warehouse_id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required | max:50 | unique:warehouses,name,' . $id . ',id',
        ]);

        $warehouse = Warehouse::find($id);
        $warehouse->name = $request->name;
        $warehouse->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_warehouse'], 'warehouse_id: ' . $id);
        return redirect()->route('warehouse.index')->with('success', 'Bodega actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
    function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['WAREHOUSE/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_warehouse'], 'warehouse_id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $warehouse = Warehouse::find($id);
        if($warehouse->status==0){
            $warehouse->status = 1;
            $warehouse->save();
            $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_warehouse'], 'warehouse_id: ' . $id);
            return redirect()->back()->with('success', 'Bodega activada con éxito');
        }
        $relatedProducts = ProductWarehouse::where('warehouse_id', $warehouse->id)
            ->where('status', 1)
            ->count();

        if ($relatedProducts > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar la bodega porque existen productos asociados a esta.');
        }

        $warehouse->status = 0;
        $warehouse->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_warehouse'], 'warehouse_id: ' . $id);
        return redirect()->back()->with('success', 'Bodega eliminada con éxito');
    }
}
