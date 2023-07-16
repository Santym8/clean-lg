<?php

namespace App\Http\Controllers\service_orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\service_orders\ServiceOrders;
use App\Models\customer\Customer;
use App\Models\security\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_service_orders'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_service_orders'], '');
        $service_orders = ServiceOrders::all();
        return view('service_orders.service_orders.index', ['service_orders' => $service_orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_service_orders'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $service_orders = ServiceOrders::all();
        $users = User::all();
        $customers = Customer::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_service_orders'], '');
        return view('service_orders.service_orders.create', ['service_orders' => $service_orders,'customers' => $customers,'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_service_orders'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'delivery_date' => 'required',
            'prepayment' => 'required',
            'customers' => 'required',
        ]);

        $service_orders = new ServiceOrders();
        $service_orders->delivery_date = $request->delivery_date;
        $service_orders->prepayment = $request->prepayment;
        $service_orders->customer_id = $request->customers;
        $service_orders->user_id = Auth::id();
        $service_orders->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_service_orders'], '');
        return redirect()->route('service_orders.index')->with('success', 'Orden de servicio creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_show_service_orders'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $service_orders = ServiceOrders::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_show_service_orders'], '');
        return view('service_orders.show', ['service_orders' => $service_orders]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $service_orders = ServiceOrders::find($id);
        $users = User::all();
        $customers = Customer::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_services'], '');
        return view('service_orders.service_orders.edit', ['service_orders' => $service_orders,'customers' => $customers,'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'delivery_date' => 'required',
            'prepayment' => 'required',
            'customers' => 'required',
        ]);

        $service_orders = ServiceOrders::find($id);
        $service_orders->delivery_date = $request->delivery_date;
        $service_orders->prepayment = $request->prepayment;
        $service_orders->delivery = $request->delivery;
        $service_orders->customer_id = $request->customers;
        $service_orders->status = $request->status;
        $service_orders->user_id = Auth::id();
        $service_orders->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_services'], '');
        return redirect()->route('service_orders.index')->with('success', 'Servicio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleNames = array("OPERADOR_ORDENES_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_service_orders'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $service_orders = ServiceOrders::find($id);
        $service_orders->status = 0;
        $service_orders->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_service_orders'], '');
        return redirect()->back()->with('success', 'Orden de servicio eliminada con éxito');
    }
}
