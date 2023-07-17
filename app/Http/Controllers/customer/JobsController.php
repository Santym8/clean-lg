<?php

namespace App\Http\Controllers\customer;

use App\Models\customer\Customer;
use App\Models\customer\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $job = Job::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_job'], '');
        return view('customer.job.index', ['jobs' => $job]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $this->addAudit(Auth::user(), $this->typeAudit['access_create_job'], '');
        return view('customer.job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $request->validate([
            'name' => 'required',

        ]);

        $job = new Job;
        $job->name = $request->name;
        // $job->status=$request->status;
        $job->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_job'], '');
        return redirect()->route('job.index')->with('success', 'Trabajo Creado con éxito.');
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
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $job = Job::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_job'], '');
        return view('customer.job.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $request->validate([
            'name' => 'required',

        ]);
        $job = Job::find($id);
        $job->name = $request->name;
        $job->status = $request->status;
        $job->save();
        // $job->update($request->all());
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_job'], '');
        return redirect()->route('job.index')->with('success', 'Trabajo Actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $roleNames = array("OPERADOR_TRABAJO");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_job'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        $job = Job::find($id);

        if ($job->id == 1) {
            return redirect()->back()->with('error', 'No puedes eliminar el trabajo principal');
        } else {
            $job->status = 0;
        }
        $job->save();

        // Actualizar la categoría de los productos asociados
        Customer::where('job_id', $id)->update(['job_id' => 1]);

        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_job'], '');
        return redirect()->back()->with('success', 'Trabajo eliminado con éxito');
    }
}
