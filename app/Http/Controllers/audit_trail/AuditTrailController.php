<?php

namespace App\Http\Controllers\audit_trail;

use App\Models\audit_trail\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class AuditTrailController extends Controller
{
    public function index()
    {
        $roleNames = array("AUDITOR");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta página');
        }

        $audit_trails = AuditTrail::all()->sortByDesc('created_at');
        return view('audit_trail.index', ['audits' => $audit_trails]);
    }
}
