<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\Module;
use App\Models\security\ModuleAction;
use App\Models\security\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_role'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $availableModuleActions = ModuleAction::whereHas('module', function ($query) {
            $query->where('status', true);
        })->get()->sortBy('module.name')->sortBy('name');

        $this->addAudit(Auth::user(), $this->typeAudit['access_create_role'], '');
        return view($this->pathViews . '.create', [
            'available_module_actions' => $availableModuleActions,
        ]);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_role'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'name' => 'required|unique:roles',
            'selected_module_actions' => 'array',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $role->moduleActions()->sync($request->selected_module_actions);

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_role'], '');
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_role'], 'Se intento editar el rol con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        if ($id == 1) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_role'], 'Se intento actualizar el rol ADMINSTRADOR_DE_SISTEMA.');
            return redirect()->route('roles.index')->with('error', 'No se puede actualizar el rol ADMINSTRADOR_DE_SISTEMA.');
        }

        $role = Role::findOrFail($id);
        $availableModuleActions = ModuleAction::whereHas('module', function ($query) {
            $query->where('status', true);
        })->get()->sortBy('module.name')->sortBy('name');

        //Delete from the list all the actions that the role already has
        foreach ($role->moduleActions as $moduleAction) {
            $availableModuleActions = $availableModuleActions->reject(function ($value, $key) use ($moduleAction) {
                return $value->id == $moduleAction->id;
            });
        }

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_role'], 'Se edito el rol con id: ' . $id);
        return view($this->pathViews . '.edit', [
            'role' => $role,
            'available_module_actions' => $availableModuleActions,
        ]);
    }

    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_role'], 'Se intento actualizar el rol con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        if ($id == 1) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_role'], 'Se intento actualizar el rol ADMINSTRADOR_DE_SISTEMA.');
            return redirect()->route('roles.index')->with('error', 'No se puede actualizar el rol ADMINSTRADOR_DE_SISTEMA.');
        }

        $request->validate([
            'name' => [Rule::unique('roles')->ignore($id)],
            'selected_module_actions' => 'array',
        ]);


        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->moduleActions()->sync($request->selected_module_actions);
        $role->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_role'], 'Se actualizo el rol con id: ' . $id);
        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['ROLE/DESTROY'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_role'], 'Se intento eliminar el rol con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        if ($id == 1) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_role'], 'Se intento eliminar el rol ADMINSTRADOR_DE_SISTEMA.');
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol ADMINSTRADOR_DE_SISTEMA.');
        }

        $role = Role::findOrFail($id);

        // Delete all relationships with users
        $role->users()->detach();

        // Delete all relationships with module actions
        $role->moduleActions()->detach();

        $role->delete();

        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_role'], 'Se elimino el rol con id: ' . $id);
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
