<?php

namespace App\Http\Controllers\security;

use App\Models\security\Module;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    private $viewsPath = 'security.system-administrator.modules';
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE/INDEX'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $modules = Module::all();
        return view($this->viewsPath . '.index', compact('modules'));
    }


    public function changeStatus(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['MODULE/CHANGE-STATUS'])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para realizar esta accion.');
        }

        $module = Module::findOrFail($id);
        $module->status = !$module->status;
        $module->save();
        return redirect()->route('modules.index')->with('success', 'Modulo actualizado exitosamente.');
    }
}
