<?php

namespace App\Http\Controllers\security;

use App\Models\security\SecModuleAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecModuleActionController extends Controller
{
    private $viewsPath = 'security.system-administrator.module_actions';

    public function index()
    {
        //Only actions that belongs to an active module will be desplayed
        $moduleActions = SecModuleAction::whereHas('module', function ($query) {
            $query->where('status', true);
        })->get()->sortBy('module.name');

        return view($this->viewsPath . '.index', compact('moduleActions'));
    }

    public function changeStatus(Request $request, string $id)
    {
        $action = SecModuleAction::find($id);
        $action->status = !$action->status;
        $action->save();

        return redirect()->route('module_actions.index');
    }
}
