<?php

namespace App\Http\Controllers\audit_trail;

use App\Models\audit_trail\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuditTrailController extends Controller
{
    public function index()
    {
        $audit_trails = AuditTrail::all()->sortByDesc('created_at');
        return view('audit_trail.index', ['audits' => $audit_trails]);
    }
}
