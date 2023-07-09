<?php

namespace App\Http\Controllers;

use App\Models\audit_trail\AuditTrail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /*
        Data must be: alias => module/name-action
    */
    protected $typeAudit = [
        // ---------------Security-----------------
        'successful_login' => 'AUTHENTICATION/SUCCESSFUL-LOGIN',
        'failed_login' => 'AUTHENTICATION/FAILED-LOGIN',
        'user_desabled' => 'AUTHENTICATION/USER-DESABLED',
        'successful_logout' => 'AUTHENTICATION/SUCCESSFUL-LOGOUT',

        'not_access_index_role' => 'SECURITY/NOT-AUTHORIZED-INDEX-ROLE',
        'access_index_role' => 'SECURITY/AUTHORIZED-INDEX-ROLE',
        'not_access_status_role' => 'SECURITY/NOT-AUTHORIZED-CHANGE-STATUS-ROLE',
        'access_status_role' => 'SECURITY/CHANGE-STATUS-ROLE',
    ];


    protected function addAudit($user, $type, $data = null)
    {
        $audit = new AuditTrail();
        $audit->user()->associate($user);
        $audit->type = $type;
        $audit->data = $data;
        $audit->save();
    }
}
