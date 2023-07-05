<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }

        return view('roles.index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create($validated);
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }

        $role = Role::findOrFail($id);

        return view('roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }

        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
            'status' => 'required|boolean',
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}