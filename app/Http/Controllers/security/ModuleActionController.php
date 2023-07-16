<?php

namespace App\Http\Controllers\security;

use App\Models\security\ModuleAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ModuleActionController extends Controller
{
    private $viewsPath = 'security.system-administrator.module_actions';

    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/INDEX'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        //Only actions that belongs to an active module will be desplayed
        $moduleActions = ModuleAction::all()->sortBy('module.name')->sortBy('name');

        return view($this->viewsPath . '.index', compact('moduleActions'));
    }

    public function edit(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/EDIT'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $moduleAction = ModuleAction::find($id);
        return view($this->viewsPath . '.edit', compact('moduleAction'));
    }

    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/UPDATE'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }
        $action = ModuleAction::find($id);
        $action->menu_text = $request->menu_text;
        $action->icon_name = $request->icon_name;
        $action->save();

        return redirect()->route('module_actions.index');
    }

    public function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE-ACTION/CHANGE-STATUS'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $action = ModuleAction::find($id);

        if ($action->module->name == 'SECURITY') {
            return redirect()->route('module_actions.index')->with('error', 'No se puede desactivar las acciones del modulo seguridad.');
        }

        $action->status = !$action->status;
        $action->save();

        return redirect()->route('module_actions.index');
    }
}
