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
        'not_access_create_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_role' => 'SECURITY/ROLE/AUTHORIZED-CREATE-VIEW',
        'not_access_store_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-STORE',
        'access_store_role' => 'SECURITY/ROLE/AUTHORIZED-STORE',
        'not_access_edit_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_role' => 'SECURITY/ROLE/AUTHORIZED-EDIT-VIEW',
        'not_access_update_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-UPDATE',
        'access_update_role' => 'SECURITY/ROLE/AUTHORIZED-UPDATE',

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

        'not_access_index_module' => 'SECURITY/MODULE/NOT-AUTHORIZED-INDEX',
        'access_index_module' => 'SECURITY/MODULE/AUTHORIZED-INDEX',
        'not_access_change_status_module' => 'SECURITY/MODULE/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_module' => 'SECURITY/MODULE/AUTHORIZED-CHANGE-STATUS',
        'not_access_edit_module' => 'SECURITY/MODULE/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_module' => 'SECURITY/MODULE/AUTHORIZED-EDIT-VIEW',
        'not_access_update_module' => 'SECURITY/MODULE/NOT-AUTHORIZED-UPDATE',
        'access_update_module' => 'SECURITY/MODULE/AUTHORIZED-UPDATE',

        'not_access_index_module_action' => 'SECURITY/MODULE-ACTION/NOT-AUTHORIZED-INDEX',
        'access_index_module_action' => 'SECURITY/MODULE-ACTION/AUTHORIZED-INDEX',
        'not_access_change_status_module_action' => 'SECURITY/MODULE-ACTION/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_module_action' => 'SECURITY/MODULE-ACTION/AUTHORIZED-CHANGE-STATUS',
        'not_access_edit_module_action' => 'SECURITY/MODULE-ACTION/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_module_action' => 'SECURITY/MODULE-ACTION/AUTHORIZED-EDIT-VIEW',
        'not_access_update_module_action' => 'SECURITY/MODULE-ACTION/NOT-AUTHORIZED-UPDATE',
        'access_update_module_action' => 'SECURITY/MODULE-ACTION/AUTHORIZED-UPDATE',


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

        'not_access_index_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-INDEX',
        'access_index_product' => 'INVENTORY/PRODUCT/AUTHORIZED-INDEX',
        'not_access_create_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_product' => 'INVENTORY/PRODUCT/AUTHORIZED-CREATE-VIEW',
        'not_access_store_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-STORE',
        'access_store_product' => 'INVENTORY/PRODUCT/AUTHORIZED-STORE',
        'not_access_edit_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_product' => 'INVENTORY/PRODUCT/AUTHORIZED-EDIT-VIEW',
        'not_access_update_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-UPDATE',
        'access_update_product' => 'INVENTORY/PRODUCT/AUTHORIZED-UPDATE',
        'not_access_destroy_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-DESTROY',
        'access_destroy_product' => 'INVENTORY/PRODUCT/AUTHORIZED-DESTROY',

        'not_access_index_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-INDEX',
        'access_index_category' => 'INVENTORY/CATEGORY/AUTHORIZED-INDEX',
        'not_access_create_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_category' => 'INVENTORY/CATEGORY/AUTHORIZED-CREATE-VIEW',
        'not_access_store_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-STORE',
        'access_store_category' => 'INVENTORY/CATEGORY/AUTHORIZED-STORE',
        'not_access_edit_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_category' => 'INVENTORY/CATEGORY/AUTHORIZED-EDIT-VIEW',
        'not_access_update_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-UPDATE',
        'access_update_category' => 'INVENTORY/CATEGORY/AUTHORIZED-UPDATE',
        'not_access_destroy_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-DESTROY',
        'access_destroy_category' => 'INVENTORY/CATEGORY/AUTHORIZED-DESTROY',
        // ---------------Customer-----------------
        'not_access_index_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-INDEX',
        'access_index_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-INDEX',
        'not_access_create_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-CREATE-VIEW',
        'not_access_store_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-STORE',
        'access_store_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-STORE',
        'not_access_show_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-SHOW',
        'access_show_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-SHOW',
        'not_access_edit_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-EDIT-VIEW',
        'not_access_update_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-UPDATE',
        'access_update_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-UPDATE',
        'not_access_destroy_customer' => 'CUSTOMER/CUSTOMER/NOT-AUTHORIZED-DESTROY',
        'access_destroy_customer' => 'CUSTOMER/CUSTOMER/AUTHORIZED-DESTROY',

        // ---------------Jobs-----------------
        'not_access_index_job' => 'JOB/JOB/NOT-AUTHORIZED-INDEX',
        'access_index_job' => 'JOB/JOB/AUTHORIZED-INDEX',
        'not_access_create_job' => 'JOB/JOB/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_job' => 'JOB/JOB/AUTHORIZED-CREATE-VIEW',
        'not_access_store_job' => 'JOB/JOB/NOT-AUTHORIZED-STORE',
        'access_store_job' => 'JOB/JOB/AUTHORIZED-STORE',
        'not_access_edit_job' => 'JOB/JOB/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_job' => 'JOB/JOB/AUTHORIZED-EDIT-VIEW',
        'not_access_update_job' => 'JOB/JOB/NOT-AUTHORIZED-UPDATE',
        'access_update_job' => 'JOB/JOB/AUTHORIZED-UPDATE',
        'not_access_destroy_job' => 'JOB/JOB/NOT-AUTHORIZED-DESTROY',
        'access_destroy_job' => 'JOB/JOB/AUTHORIZED-DESTROY',

    ];


    protected function addAudit($user, $type, $data = null)
    {
        $audit = new AuditTrail();
        $audit->user()->associate($user);
        $audit->type = $type;
        $audit->data = $data;
        $audit->ip = request()->ip();
        $audit->save();
    }
}
