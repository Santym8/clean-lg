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
        'successful_login' => 'AUTHENTICATION/SUCCESSFUL-LOGIN',
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
