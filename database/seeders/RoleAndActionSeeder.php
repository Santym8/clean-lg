<?php

namespace Database\Seeders;

use App\Models\security\ModuleAction;
use App\Models\security\Role;
use App\Models\security\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAndActionSeeder extends Seeder
{

    public function run(): void
    {
        foreach ($this->roleAndActionList as $roleName => $actions) {
            $role = Role::create([
                'name' => $roleName,
            ]);

            if (is_array($actions)) {
                foreach ($actions as $action) {
                    $role->moduleActions()->attach(
                        ModuleAction::where('name', $action)->first()
                    );
                }
            }
        }

        // All roles to admin
        $roles = Role::all();
        $user = User::where('id', 1)->first();
        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }
    }

    private $roleAndActionList = [

        'ADMINSTRADOR_DE_SISTEMA' => [
            //MODULES
            'MODULE/INDEX',
            'MODULE/CHANGE-STATUS',
            'MODULE/EDIT',
            'MODULE/UPDATE',
            //MODULE-ACTIONS
            'MODULE-ACTION/INDEX',
            'MODULE-ACTION/CHANGE-STATUS',
            'MODULE-ACTION/EDIT',
            'MODULE-ACTION/UPDATE',
            //ROLES
            'ROLE/INDEX',
            'ROLE/CHANGE-STATUS',
            'ROLE/EDIT',
            'ROLE/UPDATE',
            'ROLE/CREATE',
            'ROLE/STORE',
            'ROLE/DESTROY',
            //USERS
            'USER/INDEX',
            'USER/CHANGE-STATUS',
            'USER/EDIT',
            'USER/UPDATE',
            'USER/CREATE',
            'USER/STORE',
            'USER/RESET_PASSWORD',
        ],

        'AUDITOR' => [
            'AUDIT/INDEX',
            'AUDIT/USER-ACTIONS',
            'AUDIT/GRAPHICS',
        ],

        'CLIENTES_USUARIO' => [
            // CUSTOMERS
            'CUSTOMERS/INDEX',
            'CUSTOMERS/CREATE',
            'CUSTOMERS/STORE',
            // JOBS
            'JOBS/INDEX',
            'JOBS/CREATE',
            'JOBS/STORE',
            // DISCOUNTS
            'DISCOUNTS/INDEX',
            'DISCOUNTS/CREATE',
            'DISCOUNTS/STORE',
        ],

        'CLIENTES_OPERADOR' => [
            // CUSTOMERS
            'CUSTOMERS/INDEX',
            'CUSTOMERS/EDIT',
            'CUSTOMERS/UPDATE',
            'CUSTOMERS/SHOW',
            'CUSTOMERS/DESTROY',
            // JOBS
            'JOBS/INDEX',
            'JOBS/EDIT',
            'JOBS/UPDATE',
            'JOBS/DESTROY',
            // DISCOUNTS
            'DISCOUNTS/INDEX',
            'DISCOUNTS/EDIT',
            'DISCOUNTS/UPDATE',
            'DISCOUNTS/SHOW',
            'DISCOUNTS/DESTROY',
        ],

        'ORDENES_DE_SERVICIO_USUARIO' => [
            // SERVICES
            'SERVICES/INDEX',
            'SERVICES/CREATE',
            'SERVICES/STORE',
            // GOODS
            'GOODS/INDEX',
            'GOODS/CREATE',
            'GOODS/STORE',
            // SERVICE ORDERS
            'SERVICE_ORDERS/INDEX',
            'SERVICE_ORDERS/CREATE',
            'SERVICE_ORDERS/STORE',
            // SERVICE ORDERS GOODS
            'SERVICE_ORDERS_GOODS/INDEX',
            'SERVICE_ORDERS_GOODS/CREATE',
            'SERVICE_ORDERS_GOODS/STORE',
            'SERVICE_ORDERS_GOODS/SHOW',
        ],

        'ORDENES_DE_SERVICIO_OPERADOR' => [
            // SERVICES
            'SERVICES/INDEX',
            'SERVICES/EDIT',
            'SERVICES/UPDATE',
            'SERVICES/SHOW',
            'SERVICES/DESTROY',
            // GOODS
            'GOODS/INDEX',
            'GOODS/EDIT',
            'GOODS/UPDATE',
            'GOODS/SHOW',
            'GOODS/DESTROY',
            // SERVICE ORDERS
            'SERVICE_ORDERS/INDEX',
            'SERVICE_ORDERS/EDIT',
            'SERVICE_ORDERS/UPDATE',
            'SERVICE_ORDERS/SHOW',
            'SERVICE_ORDERS/DESTROY',
            // SERVICE ORDERS GOODS
            'SERVICE_ORDERS_GOODS/INDEX',
            'SERVICE_ORDERS_GOODS/EDIT',
            'SERVICE_ORDERS_GOODS/UPDATE',
            'SERVICE_ORDERS_GOODS/SHOW',
            'SERVICE_ORDERS_GOODS/DESTROY',
        ],

        'BODEGA_USUARIO' => [
            // WAREHOUSE
            'WAREHOUSE/INDEX',
            'WAREHOUSE/CREATE',
            'WAREHOUSE/STORE',
            // PRODUCT
            'PRODUCT/INDEX',
            'PRODUCT/CREATE',
            'PRODUCT/STORE',
            // CATEGORY
            'CATEGORY/INDEX',
            'CATEGORY/CREATE',
            'CATEGORY/STORE',
            // PRODUCT WAREHOUSE
            'PRODUCT-WAREHOUSE/INDEX',
            'PRODUCT-WAREHOUSE/CREATE',
            'PRODUCT-WAREHOUSE/STORE',
            // PRODUCT MOVEMENT
            'PRODUCT-MOVEMENT/INDEX',
            'PRODUCT-MOVEMENT/CREATE',
            'PRODUCT-MOVEMENT/STORE',
        ],

        'BODEGA_OPERADOR' => [
            // WAREHOUSE
            'WAREHOUSE/INDEX',
            'WAREHOUSE/EDIT',
            'WAREHOUSE/UPDATE',
            'WAREHOUSE/CHANGE-STATUS',
            // PRODUCT
            'PRODUCT/INDEX',
            'PRODUCT/EDIT',
            'PRODUCT/UPDATE',
            'PRODUCT/CHANGE-STATUS',
            // CATEGORY
            'CATEGORY/INDEX',
            'CATEGORY/EDIT',
            'CATEGORY/UPDATE',
            'CATEGORY/CHANGE-STATUS',
            // PRODUCT WAREHOUSE
            'PRODUCT-WAREHOUSE/INDEX',
            'PRODUCT-WAREHOUSE/EDIT',
            'PRODUCT-WAREHOUSE/UPDATE',
            'PRODUCT-WAREHOUSE/CHANGE-STATUS',
            // PRODUCT MOVEMENT
            'PRODUCT-MOVEMENT/INDEX',
            'PRODUCT-MOVEMENT/EDIT',
            'PRODUCT-MOVEMENT/UPDATE',
            'PRODUCT-MOVEMENT/DESTROY',
        ],
    ];
}
