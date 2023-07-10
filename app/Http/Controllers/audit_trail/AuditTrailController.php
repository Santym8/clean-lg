<?php

namespace App\Http\Controllers\audit_trail;

use App\Http\Controllers\Controller;
use App\Models\audit_trail\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuditTrailController extends Controller
{
    public function index()
    {
        $roleNames = array("AUDITOR");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_audit'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta página');
        }

        $audit_trails = AuditTrail::all()->sortByDesc('created_at');

        $this->addAudit(Auth::user(), $this->typeAudit['access_index_audit'], '');
        return view('audit_trail.index', ['audits' => $audit_trails]);
    }
}
