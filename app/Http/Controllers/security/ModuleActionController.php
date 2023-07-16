<?php

namespace App\Http\Controllers\security;

use App\Models\security\ModuleAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ModuleActionController extends \App\Http\Controllers\Controller
{
    private $viewsPath = 'security.system-administrator.module_actions';

    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_module_action'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        //Only actions that belongs to an active module will be desplayed
        $moduleActions = ModuleAction::all()->sortBy('module.name')->sortBy('name');

        $this->addAudit(Auth::user(), $this->typeAudit['access_index_module_action'], '');
        return view($this->viewsPath . '.index', compact('moduleActions'));
    }

    public function edit(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_module_action'], 'Se intento editar la accion con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $moduleAction = ModuleAction::find($id);

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_module_action'], 'Se edito la accion con id: ' . $id);
        return view($this->viewsPath . '.edit', compact('moduleAction'));
    }

    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_module_action'], 'Se intento actualizar la accion con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }
        $action = ModuleAction::find($id);
        $action->menu_text = $request->menu_text;
        $action->icon_name = $request->icon_name;
        $action->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_module_action'], 'Se actualizo la accion con id: ' . $id);
        return redirect()->route('module_actions.index');
    }

    public function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_module_action'], 'Se intento modificar el estado de la accion con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $action = ModuleAction::find($id);

        if ($action->module->name == 'SECURITY') {
            return redirect()->route('module_actions.index')->with('error', 'No se puede desactivar las acciones del modulo seguridad.');
        }

        $action->status = !$action->status;
        $action->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_module_action'], 'Se modifico el estado de la accion con id: ' . $id);
        return redirect()->route('module_actions.index');
    }
}
