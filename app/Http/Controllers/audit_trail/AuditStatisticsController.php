<?php

namespace App\Http\Controllers\audit_trail;

use App\Http\Controllers\Controller;
use App\Models\audit_trail\AuditTrail;
use App\Models\security\User;
use Illuminate\Http\Request;

class AuditStatisticsController extends Controller
{
    public function userActions()
    {
        //Count the number of actions per user

        $audit_trails = User::selectRaw('users.id, users.identification, users.name, users.last_name, count(audit_trails.id) as number_actions')
            ->leftjoin('audit_trails', 'users.id', '=', 'audit_trails.user_id')
            ->groupBy('users.id')->groupBy('users.identification')->groupBy('users.name')->groupBy('users.last_name')
            ->orderBy('number_actions', 'desc')
            ->get();

        //Get level of activity per user
        $actionsUser = [];
        foreach ($audit_trails as $audit_trail) {
            $actionsUser[$audit_trail->id] = $audit_trail->number_actions;
        }

        $likertLevelsUser = [];
        $maxNumberActions = max($actionsUser);
        foreach ($actionsUser as $key => $value) {
            $percentage = $value / $maxNumberActions * 100;

            if ($percentage >= 80) {
                $likertLevelsUser[$key] = 'Muy Activo';
            } elseif ($percentage >= 60) {
                $likertLevelsUser[$key] = 'Activo';
            } elseif ($percentage >= 40) {
                $likertLevelsUser[$key] = 'Moderado';
            } elseif ($percentage >= 20) {
                $likertLevelsUser[$key] = 'Incativo';
            } else {
                $likertLevelsUser[$key] = 'Muy Inactivo';
            }
        }

        return view('audit_trail.user_actions', [
            'audits' => $audit_trails,
            'likertLevelsUser' => $likertLevelsUser
        ]);
    }
}
