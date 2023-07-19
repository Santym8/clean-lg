<?php

namespace App\Http\Controllers\customer;


use Illuminate\Http\Request;
use App\Models\customer\Customer;
use App\Models\customer\Job;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    private $pathViews = 'customer.customers';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_customer'], '');
        return view($this->pathViews . '.index', [
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $customers = Customer::all();
        $job = Job::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_customer'], '');
        return view($this->pathViews . '.create', ['customers' => $customers,'jobs' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type' => 'required',
            'identification' => 'required|min:10|max:10|unique:customers',
            'phone_number' => 'required|min:10|max:10',
            'address' => 'required|unique:customers|max:50',
            'jobs' => 'required',
        ]);

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->identification_type = $request->identification_type;
        $customer->identification = $request->identification;
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;
        $customer->job_id = $request->jobs;
        $customer->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_customer'], '');
        return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/SHOW'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_show_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $customers = Customer::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_show_customer'], '');
        return view('customers.show', ['customers' => $customers]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $customer = Customer::find($id);
        $job = Job::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_customer'], '');
        return view($this->pathViews . '.edit', ['customer' => $customer, 'jobs' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type' => 'required',
            'identification' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'jobs' => 'required',
        ]);

        $customer = Customer::find($id);
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->identification_type = $request->identification_type;
        $customer->identification = $request->identification;
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->job_id = $request->jobs;
        $customer->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_customer'], '');
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['CUSTOMERS/DESTROY'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_customer'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $customer = Customer::find($id);
        $customer->status = 0;
        $customer->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_customer'], '');
        return redirect()->back()->with('success', 'Cliente eliminado con éxito');
    }
}
