<?php

namespace App\Http\Controllers\audit_trail;

use App\Http\Controllers\Controller;
use App\Models\audit_trail\AuditTrail;
use App\Models\security\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AudiGraphicsController extends Controller
{
    public function graphics()
    {
        if (!Gate::allows('action-allowed-to-user', ['AUDIT/GRAPHICS'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_graphics'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta página');
        }

        $this->addAudit(Auth::user(), $this->typeAudit['acces_graphics'], '');

        // Obtener los módulos más visitados (los 5 primeros) con la cantidad de visitas
        $results = AuditTrail::select(DB::raw('SUBSTRING_INDEX(type, "/", -2) as module'), DB::raw('COUNT(*) as count'))
            ->groupBy('module')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $chartData = array();
        foreach ($results as $row) {
            $chartData[] = array('name' => $row['module'], 'y' => intval($row['count']));
        }

        $chartDataJson = json_encode($chartData);

        // Obtener los usuarios y sus visitas por módulo
        $results2 = AuditTrail::selectRaw('modules.name as module_name, MAX(modules.menu_text) as submodule_name, users.name as user_name, COUNT(*) as count')
            ->join('modules', 'audit_trails.type', 'LIKE', DB::raw("CONCAT('%', modules.name, '/%')"))
            ->join('users', 'audit_trails.user_id', '=', 'users.id')
            ->groupBy('user_name', 'module_name')
            ->get();

        $chartData2 = [];

        foreach ($results2 as $row) {
            $module = $row->module_name;
            $submodule = $row->submodule_name;
            $user = $row->user_name;
            $visits = intval($row->count);

            if (!isset($chartData2[$user])) {
                $chartData2[$user] = ['name' => $user, 'data' => []];
            }

            $chartData2[$user]['data'][] = ['name' => $module, 'y' => $visits];
        }

        $chartDataJson2 = json_encode(array_values($chartData2));

        // Retorna la vista con los datos para la gráfica de pastel
        return view('audit_trail.graphics', compact('chartDataJson', 'chartDataJson2', 'chartData2'));
    }
}
