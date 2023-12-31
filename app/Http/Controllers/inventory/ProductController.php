<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inventory\Product;
use App\Models\inventory\Category;
use App\Models\inventory\ProductWarehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
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
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $products = Product::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_product'], '');
        return view('inventory.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $categories = Category::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_product'], '');
        return view('inventory.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required | unique:products|max:25',
            'category' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_product'], '');
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (!Gate::allows('action-allowed-to-user', ['PRODUCT/SHOW'])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_product'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }
        // $product = Product::find($id);
        // $this->addAudit(Auth::user(), $this->typeAudit['access_index_product'], '');
        // return view('inventory.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $product = Product::find($id);
        $categories = Category::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_product'], '');
        return view('inventory.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required | max:25 | unique:products,name,' . $id . ',id',
            'category' => 'required|exists:categories,id',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_product'], '');
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
    function changeStatus(Request $request, string $id){
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_product'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $product = Product::find($id);
        if($product->status==0){
            $product->status = 1;
            $product->save();
            $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_product'], '');
            return redirect()->back()->with('success', 'Producto activado con éxito');
        }
        $relatedProducts = ProductWarehouse::where('product_id', $product->id)
            ->where('status', 1)
            ->count();
        if ($relatedProducts > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar el producto porque tiene productos relacionados en bodega');
        }
        $product->status = 0;
        $product->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_product'], '');
        return redirect()->back()->with('success', 'Producto eliminado con éxito');
    }
}
