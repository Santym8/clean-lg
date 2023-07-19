<?php

namespace App\Http\Controllers\security;

use App\Models\security\Module;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ModuleController extends \App\Http\Controllers\Controller
{
    private $viewsPath = 'security.system-administrator.modules';
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_module'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $modules = Module::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_module'], '');
        return view($this->viewsPath . '.index', compact('modules'));
    }


    public function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE/CHANGE-STATUS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_module'], 'Se intento modificar el estado del modulo con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $module = Module::findOrFail($id);

        if($module->name == 'SECURITY'){
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_change_status_module'], 'Se intento modificar el estado del modulo de seguridad.');
            return redirect()->route('modules.index')->with('error', 'No se puede desactivar el modulo de seguridad.');
        }

        $module->status = !$module->status;
        $module->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_change_status_module'], 'Se modifico el estado del modulo con id: ' . $id);
        return redirect()->route('modules.index')->with('success', 'Modulo actualizado exitosamente.');
    }

    public function edit(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_module'], 'Se intento editar el modulo con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $module = Module::findOrFail($id);

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_module'], 'Se edito el modulo con id: ' . $id);
        return view($this->viewsPath . '.edit', compact('module'));
    }

    public function update(Request $request, string $id){
        if (!Gate::allows('action-allowed-to-user', ['MODULE/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_module'], 'Se intento actualizar el modulo con id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $module = Module::findOrFail($id);
        $module->menu_text = $request->menu_text;
        $module->icon_name = $request->icon_name;
        $module->color = $request->color;
        $module->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_module'], 'Se actualizo el modulo con id: ' . $id);
        return redirect()->route('modules.index')->with('success', 'Modulo actualizado exitosamente.');
    }
}
