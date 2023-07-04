<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class category_controller extends Controller
{
    /**
     * Display a listing of the resource.
     * index function is used to display the category page
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
        $category = Category::all();
        return view('inventory.category.index', ['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoria creada con éxito');
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
        $category = Category::find($id);
        return view('inventory.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoria actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return redirect()->back()->with('success', 'Categoria eliminada con éxito'); // Ejemplo de redirección con mensaje de éxito
    }
}
