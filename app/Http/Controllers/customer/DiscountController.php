<?php

namespace App\Http\Controllers\customer;;

use Illuminate\Http\Request;
use App\Models\customer\Customer;
use App\Models\customer\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DiscountController extends Controller
{
    private $pathViews = 'customer.discounts';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_discounts'], '');
        return view($this->pathViews . '.index', [
            'discounts' => Discount::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $discounts = Discount::all();
        $customers = Customer::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_discounts'], '');
        return view($this->pathViews . '.create', ['discounts' => $discounts, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'percentage' => 'required|numeric',
            'customers' => 'required',

        ]);

        $discounts = new Discount;
        $discounts->percentage = $request->percentage;
        $discounts->customer_id = $request->customers;
        $discounts->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_store_discounts'], '');
        return redirect()->route('discounts.index')->with('success', 'Descuento Creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/SHOW'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_show_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $discounts = Discount::find($id);
        $this->addAudit(Auth::user(), $this->typeAudit['access_show_discounts'], '');
        return view('customers.show', ['discounts' => $discounts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $discount = Discount::find($id);
        $customer = Customer::all();

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_discounts'], '');
        return view($this->pathViews . '.edit', ['discount' => $discount,'customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'percentage' => 'required|numeric',
            'customers' => 'required',

        ]);
        $discounts = Discount::find($id);
        $discounts->percentage = $request->percentage;
        $discounts->status = $request->status;
        $discounts->customer_id = $request->customers;
        $discounts->save();
        // $job->update($request->all());
        $this->addAudit(Auth::user(), $this->typeAudit['access_update_discounts'], '');
        return redirect()->route('discounts.index')->with('success', 'Descuento Actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['DISCOUNTS/DESTROY'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_discounts'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $discount = Discount::find($id);
        $discount->status = 0;
        $discount->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_discounts'], '');
        return redirect()->back()->with('success', 'Descuento eliminado con éxito');
    }
}
