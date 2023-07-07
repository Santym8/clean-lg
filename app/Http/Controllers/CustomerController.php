<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Job;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $job = Job::all();
        return view('customer.customers.create', ['customers' => $customers,'jobs' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification_type' => 'required',
            'identification' => 'required|unique:customers',
            'phone_number' => 'required',
            'address' => 'required',
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

        return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customers = Customer::find($id);
        return view('customers.show', ['customers' => $customers]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        $job = Job::all();
        return view('customer.customers.edit', ['customer' => $customer, 'jobs' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->status = 0;
        $customer->save();
        return redirect()->back()->with('success', 'Cliente eliminado con éxito');
    }
}
