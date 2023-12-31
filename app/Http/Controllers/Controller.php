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
        'not_access_destroy_role' => 'SECURITY/ROLE/NOT-AUTHORIZED-DESTROY',
        'access_destroy_role' => 'SECURITY/ROLE/AUTHORIZED-DESTROY',

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
        'not_access_reset_password_user' => 'SECURITY/USER/NOT-AUTHORIZED-RESET-PASSWORD',
        'access_reset_password_user' => 'SECURITY/USER/AUTHORIZED-RESET-PASSWORD',

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

        'access_update_user_profile' => 'SECURITY/USER-PROFILE/AUTHORIZED-UPDATE',
        'access_update_user_password' => 'SECURITY/USER-PASSWORD/AUTHORIZED-UPDATE',
        'not_access_update_user_password' => 'SECURITY/USER-PASSWORD/NOT-AUTHORIZED-UPDATE',

        // ---------------Audit Trail-----------------
        'not_access_index_audit' => 'AUDIT/AUDIT-TRAIL/NOT-AUTHORIZED-INDEX',
        'access_index_audit' => 'AUDIT/AUDIT-TRAIL/AUTHORIZED-INDEX',
        'acces_user_actions' => 'AUDIT/AUDIT-TRAIL/USER-ACTIONS',
        'not_access_user_actions' => 'AUDIT/AUDIT-TRAIL/NOT-AUTHORIZED-USER-ACTIONS',

        'acces_graphics' => 'AUDIT/AUDIT-TRAIL/GRAPHICS',
        'not_access_graphics' => 'AUDIT/AUDIT-TRAIL/NOT-AUTHORIZED-GRAPHICS',

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
        'not_access_change_status_warehouse' => 'INVENTORY/WAREHOUSE/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_warehouse' => 'INVENTORY/WAREHOUSE/AUTHORIZED-CHANGE-STATUS',

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
        'not_access_change_status_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_product_warehouse' => 'INVENTORY/PRODUCT-WAREHOUSE/AUTHORIZED-CHANGE-STATUS',

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
        'not_access_change_status_product' => 'INVENTORY/PRODUCT/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_product' => 'INVENTORY/PRODUCT/AUTHORIZED-CHANGE-STATUS',

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
        'not_access_change_status_category' => 'INVENTORY/CATEGORY/NOT-AUTHORIZED-CHANGE-STATUS',
        'access_change_status_category' => 'INVENTORY/CATEGORY/AUTHORIZED-CHANGE-STATUS',

        'not_access_index_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-INDEX',
        'access_index_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-INDEX',
        'not_access_create_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-CREATE-VIEW',
        'not_access_store_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-STORE',
        'access_store_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-STORE',
        'not_access_edit_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-EDIT-VIEW',
        'not_access_update_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-UPDATE',
        'access_update_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-UPDATE',
        'not_access_destroy_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/NOT-AUTHORIZED-DESTROY',
        'access_destroy_product_movement' => 'INVENTORY/PRODUCT-MOVEMENT/AUTHORIZED-DESTROY',

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

        // ---------------Discounts-----------------
        'not_access_index_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-INDEX',
        'access_index_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-INDEX',
        'not_access_create_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-CREATE-VIEW',
        'not_access_store_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-STORE',
        'access_store_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-STORE',
        'not_access_show_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-SHOW',
        'access_show_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-SHOW',
        'not_access_edit_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-EDIT-VIEW',
        'not_access_update_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-UPDATE',
        'access_update_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-UPDATE',
        'not_access_destroy_discounts' => 'CUSTOMER/DISCOUNTS/NOT-AUTHORIZED-DESTROY',
        'access_destroy_discounts' => 'CUSTOMER/DISCOUNTS/AUTHORIZED-DESTROY',

        // ---------------Services-----------------
        'not_access_index_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-INDEX',
        'access_index_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-INDEX',
        'not_access_create_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-CREATE-VIEW',
        'not_access_store_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-STORE',
        'access_store_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-STORE',
        'not_access_edit_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-EDIT-VIEW',
        'not_access_update_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-UPDATE',
        'access_update_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-UPDATE',
        'not_access_destroy_services' => 'SERVICE_ORDERS/SERVICES/NOT-AUTHORIZED-DESTROY',
        'access_destroy_services' => 'SERVICE_ORDERS/SERVICES/AUTHORIZED-DESTROY',

        // ---------------Goods-----------------
        'not_access_index_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-INDEX',
        'access_index_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-INDEX',
        'not_access_create_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-CREATE-VIEW',
        'not_access_store_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-STORE',
        'access_store_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-STORE',
        'not_access_show_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-SHOW',
        'access_show_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-SHOW',
        'not_access_edit_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-EDIT-VIEW',
        'not_access_update_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-UPDATE',
        'access_update_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-UPDATE',
        'not_access_destroy_goods' => 'SERVICE_ORDERS/GOODS/NOT-AUTHORIZED-DESTROY',
        'access_destroy_goods' => 'SERVICE_ORDERS/GOODS/AUTHORIZED-DESTROY',

        // ---------------serviceOrders-----------------
        'not_access_index_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-INDEX',
        'access_index_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-INDEX',
        'not_access_create_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-CREATE-VIEW',
        'not_access_store_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-STORE',
        'access_store_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-STORE',
        'not_access_show_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-SHOW',
        'access_show_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-SHOW',
        'not_access_edit_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-EDIT-VIEW',
        'access_edit_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-EDIT-VIEW',
        'not_access_update_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-UPDATE',
        'access_update_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-UPDATE',
        'not_access_destroy_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/NOT-AUTHORIZED-DESTROY',
        'access_destroy_service_orders' => 'SERVICE_ORDERS/SERVICE_ORDERS/AUTHORIZED-DESTROY',

        // ---------------serviceOrdersGoods-----------------
        'not_access_index_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/NOT-AUTHORIZED-INDEX',
        'access_index_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/AUTHORIZED-INDEX',
        'not_access_create_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/NOT-AUTHORIZED-CREATE-VIEW',
        'access_create_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/AUTHORIZED-CREATE-VIEW',
        'not_access_store_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/NOT-AUTHORIZED-STORE',
        'access_store_service_orders_goods' => 'SERVICE_ORDERS/SERVICE_ORDERS_GOODS/AUTHORIZED-STORE',
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
