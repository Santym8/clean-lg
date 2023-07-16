<?php

namespace App\Http\Controllers\service_orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\service_orders\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $services = Services::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_services'], '');
        return view('service_orders.services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $this->addAudit(Auth::user(), $this->typeAudit['access_create_services'], '');
        return view('service_orders.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        
        $request->validate([
            'name' => 'required',
            'cost' => 'required|numeric',
        ]);

        $services = new Services;
        $services->name = $request->name;
        $services->cost = $request->cost;
        $services->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_services'], '');
        return redirect()->route('services.index')->with('success', 'Servicio creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $service = Services::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_services'], '');
        return view('service_orders.services.edit', ['services' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $request->validate([
            'name' => 'required',
            'cost' => 'required|numeric',
        ]);

        $service = Services::find($id);
        $service->name = $request->name;
        $service->cost = $request->cost;
        $service->status = $request->status;
        $service->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_services'], '');
        return redirect()->route('services.index')->with('success', 'Servicio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleNames = array("OPERADOR_SERVICIOS");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_services'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $services = Services::find($id);

        if ($services->id == 1) {
            return redirect()->back()->with('error', 'No puedes eliminar el trabajo principal');
        } else {
            $services->status = 0;
        }
        $services->save();

        // Actualizar la categoría de los productos asociados
        //Customer::where('job_id', $id)->update(['job_id' => 1]);

        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_services'], '');
        return redirect()->back()->with('success', 'Trabajo eliminado con éxito');
    }
}
