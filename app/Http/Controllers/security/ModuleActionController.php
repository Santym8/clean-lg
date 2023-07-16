<?php

namespace App\Http\Controllers\security;

use App\Models\security\ModuleAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ModuleActionController extends Controller
{
    private $viewsPath = 'security.system-administrator.module_actions';

    public function index()
    {
        //Only actions that belongs to an active module will be desplayed
        $moduleActions = ModuleAction::whereHas('module', function ($query) {
            $query->where('status', true);
        })->get()->sortBy('module.name')->sortBy('name');

        return view($this->viewsPath . '.index', compact('moduleActions'));
    }

    public function edit(Request $request, string $id)
    {
        $moduleAction = ModuleAction::find($id);
        return view($this->viewsPath . '.edit', compact('moduleAction'));
    }

    public function update(Request $request, string $id)
    {
        $action = ModuleAction::find($id);
        $action->icon_name = $request->icon_name;
        $action->save();

        return redirect()->route('module_actions.index');
    }

    public function changeStatus(Request $request, string $id)
    {
        $action = ModuleAction::find($id);
        $action->status = !$action->status;
        $action->save();

        return redirect()->route('module_actions.index');
    }
}
