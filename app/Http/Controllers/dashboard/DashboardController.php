<?php

namespace App\Http\Controllers\dashboard;

use App\Models\security\Module;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $modules = Module::where('status', 1)->get();

        foreach ($modules as $module) {
            if (!Gate::allows('has-access-to-at-least-one-action-module', [$module->name])) {
                $modules = $modules->reject(function ($value, $key) use ($module) {
                    return $value->id == $module->id;
                });
                continue;
            }
            $module->routeFirstDisplayableAction = $this->routeFirstDisplayableAction($module);
        }

        error_log($modules);

        return view('dashboard.index', compact('modules'));
    }

    private function routeFirstDisplayableAction(Module $module)
    {
        $displayableActions = $module->moduleActions->where('displayable_menu', 1);
        foreach ($displayableActions as $action) {
            if (Gate::allows('action-allowed-to-user', [$action->name])) {
                return $action->route;
            }
        }
    }
}
