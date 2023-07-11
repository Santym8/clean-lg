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
        Data must be: alias => module/controller/name-action
    */
    protected $typeAudit = [
        // ---------------Security-----------------
        'successful_login' => 'SECURITY/LOGIN/SUCCESSFUL',
        'failed_login' => 'SECURITY/LOGIN/FAILED',
        'user_desabled' => 'SECURITY/LOGIN/USER-DESABLED',
        'successful_logout' => 'SECURITY/LOGOUT/SUCCESSFUL',

        'not_access_index_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-INDEX',
        'access_index_role' => 'SECURITY/ROLE/AUTHORIZED-INDEX',
        'not_access_status_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_status_role' => 'SECURITY/ROLE/CHANGE-STATUS',

        'not_access_index_user' => 'SECURITY/USER/NOT-AUTHORIZED-INDEX',
        'access_index_user' => 'SECURITY/USER/AUTHORIZED-INDEX',
        'not_access_create_user' => 'SECURITY/USER/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_user' => 'SECURITY/USER/AUTHORIZED-CREATE-VIEW',
        'not_access_store_user' => 'SECURITY/USER/NOT-AUTHORIZED-STORE',
        'access_store_user' => 'SECURITY/USER/AUTHORIZED-STORE',
        'not_access_edit_user' => 'SECURITY/USER/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_user' => 'SECURITY/USER/AUTHORIZED-EDIT-VIEW',
        'not_access_update_user' => 'SECURITY/USER/NOT-AUTHORIZED-UPDATE',
        'access_update_user' => 'SECURITY/USER/AUTHORIZED-UPDATE',

        // ---------------Audit Trail-----------------
        'not_access_index_audit' => 'AUDIT/AUDIT-TRAIL/NOT-AUTHORIZED-INDEX',
        'access_index_audit' => 'AUDIT/AUDIT-TRAIL/AUTHORIZED-INDEX',
        'acces_user_actions' => 'AUDIT/AUDIT-TRAIL/USER-ACTIONS',
        'not_access_user_actions' => 'AUDIT/AUDIT-TRAIL/NOT-AUTHORIZED-USER-ACTIONS',

        //----------------Inventory-------------------
        'not_access_index_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-INDEX',
        'access_index_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-INDEX',
        'not_access_create_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-CREATE-VIEW',
        'not_access_store_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-STORE',
        'access_store_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-STORE',
        'not_access_edit_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-EDIT-VIEW',
        'not_access_update_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-UPDATE',
        'access_update_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-UPDATE',
        'not_access_destroy_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-DESTROY',
        'access_destroy_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-DESTROY',

        'not_access_index_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-INDEX',
        'access_index_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-INDEX',
        'not_access_create_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-CREATE-VIEW',
        'not_access_store_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-STORE',
        'access_store_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-STORE',
        'not_access_edit_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-EDIT-VIEW',
        'not_access_update_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-UPDATE',
        'access_update_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-UPDATE',
        'not_access_destroy_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-DESTROY',
        'access_destroy_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-DESTROY',

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
