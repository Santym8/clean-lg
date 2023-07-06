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
     * Update the specified resource in storage.
     */
    public function changeStatus(Request $request, string $id)
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard');
        }

        $role = Role::findOrFail($id);
        $role->status = !$role->status;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

}
