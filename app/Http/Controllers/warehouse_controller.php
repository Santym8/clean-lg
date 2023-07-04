<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class warehouse_controller extends Controller
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
        $warehouses = Warehouse::all();
        return view('inventory.warehouse.index', ['warehouses' => $warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->save();

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
        $warehouse = Warehouse::find($id);

        return view('inventory.warehouse.edit', ['warehouse' => $warehouse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $warehouse = Warehouse::find($id);
        $warehouse->name = $request->name;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('success', 'Bodega actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $warehouse = Warehouse::find($id);
        $warehouse->status = 0;
        $warehouse->save();
        return redirect()->back()->with('success', 'Bodega eliminada con éxito'); // Ejemplo de redirección con mensaje de éxito


    }
}
