<?php

namespace App\Http\Controllers\service_orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\service_orders\Goods;
use App\Models\service_orders\Services;
use App\Models\service_orders\ServiceOrders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_goods'], '');
        $goods = Goods::all();
        return view('service_orders.goods.index', ['goods' => $goods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::all();
        $services = Services::all();
        $service_orders = ServiceOrders::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_goods'], '');
        return view('service_orders.goods.create', ['goods' => $goods,'services' => $services,'service_orders' => $service_orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'description' => 'required',
            'cost' => 'required|numeric',
            'services' => 'required',
            'service_orders' => 'required',
        ]);

        $goods = new Goods();
        $goods->description = $request->description;
        $goods->cost = $request->cost;
        $goods->service_id = $request->services;
        $goods->service_order_id = $request->service_orders;
        $goods->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_goods'], '');
        return redirect()->route('goods.index')->with('success', 'Bien creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_show_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_show_goods'], '');
        return view('goods.show', ['goods' => $goods]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::find($id);
        $services = Services::all();
        $service_orders = ServiceOrders::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_goods'], '');
        return view('service_orders.goods.edit', ['goods' => $goods,'services' => $services, 'service_orders' => $service_orders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'description' => 'required',
            'cost' => 'required|numeric',
            'services' => 'required',
            'service_orders' => 'required',
        ]);

        $goods = Goods::find($id);
        $goods->description = $request->description;
        $goods->cost = $request->cost;
        $goods->status = $request->status;
        $goods->service_id = $request->services;  
        $goods->service_order_id = $request->service_orders;    
        $goods->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_goods'], '');
        return redirect()->route('goods.index')->with('success', 'Bien actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleNames = array("OPERADOR_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::find($id);
        $goods->status = 0;
        $goods->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_goods'], '');
        return redirect()->back()->with('success', 'Bien eliminado con éxito');
    }
}
