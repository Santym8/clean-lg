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
            'AUDIT/USER-ACTIONS'
        ],
        'OPERADOR_CLIENTE' => [
            'CUSTOMERS/INDEX',
            'CUSTOMERS/CREATE',
            'CUSTOMERS/STORE',
            'CUSTOMERS/EDIT',
            'CUSTOMERS/UPDATE',
            'CUSTOMERS/SHOW',
            'CUSTOMERS/DESTROY',
        ],
        'OPERADOR_TRABAJO' => [
            'JOBS/INDEX',
            'JOBS/CREATE',
            'JOBS/STORE',
            'JOBS/EDIT',
            'JOBS/UPDATE',
            'JOBS/DESTROY',
        ],
        'BODEGUERO_INVENTARIO',
        'OPERADOR_CLIENTE',
        'OPERADOR_TRABAJO',
        'OPERADOR_SERVICIOS'=> [
            'SERVICES/INDEX',
            'SERVICES/CREATE',
            'SERVICES/STORE',
            'SERVICES/EDIT',
            'SERVICES/UPDATE',
            'SERVICES/SHOW',
            'SERVICES/DESTROY',
        ],
        'OPERADOR_BIENES'=> [
            'GOODS/INDEX',
            'GOODS/CREATE',
            'GOODS/STORE',
            'GOODS/EDIT',
            'GOODS/UPDATE',
            'GOODS/SHOW',
            'GOODS/DESTROY',
        ],
        'OPERADOR_ORDENES_SERVICIOS'=> [
            'SERVICE_ORDERS/INDEX',
            'SERVICE_ORDERS/CREATE',
            'SERVICE_ORDERS/STORE',
            'SERVICE_ORDERS/EDIT',
            'SERVICE_ORDERS/UPDATE',
            'SERVICE_ORDERS/SHOW',
            'SERVICE_ORDERS/DESTROY',
        ],
        'OPERADOR_ORDENES_SERVICIOS_BIENES'=> [
            'SERVICE_ORDERS_GOODS/INDEX',
            'SERVICE_ORDERS_GOODS/CREATE',
            'SERVICE_ORDERS_GOODS/STORE',
            'SERVICE_ORDERS_GOODS/EDIT',
            'SERVICE_ORDERS_GOODS/UPDATE',
            'SERVICE_ORDERS_GOODS/SHOW',
            'SERVICE_ORDERS_GOODS/DESTROY',
        'BODEGUERO_INVENTARIO' => [
            //WAREHOUSE
            'WAREHOUSE/INDEX',
            'WAREHOUSE/EDIT',
            'WAREHOUSE/UPDATE',
            'WAREHOUSE/CREATE',
            'WAREHOUSE/STORE',
            'WAREHOUSE/CHANGE-STATUS',
            //PRODUCT
            'PRODUCT/INDEX',
            'PRODUCT/EDIT',
            'PRODUCT/UPDATE',
            'PRODUCT/CREATE',
            'PRODUCT/STORE',
            'PRODUCT/CHANGE-STATUS',
            //CATEGORY
            'CATEGORY/INDEX',
            'CATEGORY/EDIT',
            'CATEGORY/UPDATE',
            'CATEGORY/CREATE',
            'CATEGORY/STORE',
            'CATEGORY/CHANGE-STATUS',
            //PRODUCT-WAREHOUSE
            'PRODUCT-WAREHOUSE/INDEX',
            'PRODUCT-WAREHOUSE/EDIT',
            'PRODUCT-WAREHOUSE/UPDATE',
            'PRODUCT-WAREHOUSE/CREATE',
            'PRODUCT-WAREHOUSE/STORE',
            'PRODUCT-WAREHOUSE/CHANGE-STATUS',
            //PRODUCT-MOVEMENT
            'PRODUCT-MOVEMENT/INDEX',
            'PRODUCT-MOVEMENT/EDIT',
            'PRODUCT-MOVEMENT/UPDATE',
            'PRODUCT-MOVEMENT/CREATE',
            'PRODUCT-MOVEMENT/STORE',
            'PRODUCT-MOVEMENT/DESTROY',
        ],
    ];
}
