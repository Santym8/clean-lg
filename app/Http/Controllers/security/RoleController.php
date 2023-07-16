<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\Module;
use App\Models\security\ModuleAction;
use App\Models\security\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

    private $pathViews = 'security.system-administrator.roles';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_role'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $this->addAudit(Auth::user(), $this->typeAudit['access_index_role'], '');
        return view($this->pathViews . '.index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/CHANGE-STATUS'])) {
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

    public function edit(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/EDIT'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $role = Role::findOrFail($id);
        $availableModuleActions = ModuleAction::whereHas('module', function ($query) {
            $query->where('status', true);
        })->get()->sortBy('module.name');

        //Delete from the list all the actions that the role already has
        foreach ($role->moduleActions as $moduleAction) {
            $availableModuleActions = $availableModuleActions->reject(function ($value, $key) use ($moduleAction) {
                return $value->id == $moduleAction->id;
            });
        }

        return view($this->pathViews . '.edit', [
            'role' => $role,
            'available_module_actions' => $availableModuleActions,
        ]);
    }

    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/UPDATE'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->moduleActions()->sync($request->selected_module_actions);
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }
}
