<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_role'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $this->addAudit(Auth::user(), $this->typeAudit['access_index_role'], '');
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
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_status_role'], 'Se intento modificar el estado del rol con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $role = Role::findOrFail($id);

        if ($role->name == 'ADMINSTRADOR_DE_SISTEMA') {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_status_role'], 'Se intento modificar el estado del rol ADMINSTRADOR_DE_SISTEMA.');
            return redirect()->route('roles.index')->with('error', 'No se puede desactivar el rol ADMINSTRADOR_DE_SISTEMA.');
        }

        $role->status = !$role->status;
        $role->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_status_role'], 'Se modifico el estado del rol con id: ' . $id);
        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }
}
