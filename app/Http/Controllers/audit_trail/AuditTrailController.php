<?php

namespace App\Http\Controllers\audit_trail;

use App\Models\audit_trail\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuditTrailController extends Controller
{
    public function index()
    {
        $audit_trails = AuditTrail::all();
        return view('audit_trail.index', ['audits' => $audit_trails]);
    }

    public function show(Request $request, int $id)
    {
        $audit_trail = AuditTrail::findOrFail($id);
        return view('audit_trail.show', ['audit_trail' => $audit_trail]);
    }
}
