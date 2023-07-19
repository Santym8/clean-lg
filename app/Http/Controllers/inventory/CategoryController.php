<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inventory\Category;
use App\Models\inventory\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
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
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $category = Category::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_category'], '');
        return view('inventory.category.index', ['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_category'], '');
        return view('inventory.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required|unique:categories|max:25',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_category'], '');
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
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $category = Category::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_category'], '');
        return view('inventory.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request -> validate([
            'name' => 'required|max:25|unique:categories,name,' . $id,
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_category'], '');
        return redirect()->route('category.index')->with('success', 'Categoria actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
    function changeStatus(Request $request, string $id){
        if (!Gate::allows('action-allowed-to-user', ['CATEGORY/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_category'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $category = Category::find($id);
        if ($category->status == 0) {
            $category->status = 1;
            $category->save();
            $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_category'], '');
            return redirect()->back()->with('success', 'Categoria activada con éxito');
        }
        $relatedCategories = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->count();
        if ($relatedCategories > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar la Categoría porque tiene productos relacionados');
        }
        $category->status = 0;
        $category->save();
        
        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_category'], '');
        return redirect()->back()->with('success', 'Categoria eliminada con éxito');
    }
}
