<?php

namespace App\Http\Controllers\security;

use App\Models\security\Module;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ModuleController extends Controller
{
    private $viewsPath = 'security.system-administrator.modules';
    public function index()
    {
        $modules = Module::all();
        return view($this->viewsPath . '.index', compact('modules'));
    }


    public function changeStatus(Request $request, string $id){
        $module = Module::findOrFail($id);
        $module->status = !$module->status;
        $module->save();
        return redirect()->route('modules.index')->with('success', 'Modulo actualizado exitosamente.');
    }
}
