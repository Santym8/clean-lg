<?php

namespace Database\Seeders;

use App\Models\security\Module;
use App\Models\security\ModuleAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleAndActionSeeder extends Seeder
{

    public function run(): void
    {
        foreach ($this->moduleAndActionsList as $moduleName => $moduleData) {
            $createdModule = Module::create([
                'name' => $moduleName,
                'menu_text' => $moduleData['menu_text'] ?? null,
                'icon_name' => $moduleData['icon_name'] ?? null,
            ]);

            if (is_array($moduleData)) {
                foreach ($moduleData['actions'] as $action) {
                    ModuleAction::create(
                        $action + ['module_id' => $createdModule->id]
                    );
                }
            }
        }
    }

    private $moduleAndActionsList = [
        'SECURITY' => [
            'menu_text' => 'SEGURIDAD',
            'icon_name' => 'mdi mdi-lock',
            'actions' => [
                //---------------Module------------
                [
                    'name' => 'MODULE/INDEX',
                    'route' => 'modules.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-cube-outline',
                    'menu_text' => 'MODULOS'
                ],
                [
                    'name' => 'MODULE/CHANGE-STATUS',
                    'route' => 'modules.changeStatus',
                ],
                [
                    'name' => 'MODULE/EDIT',
                    'route' => 'modules.edit',
                ],
                [
                    'name' => 'MODULE/UPDATE',
                    'route' => 'modules.update',
                ],
                //---------------Module Action------------
                [
                    'name' => 'MODULE-ACTION/INDEX',
                    'route' => 'module_actions.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-brightness-auto',
                    'menu_text' => 'ACCIONES DE MODULO'
                ],
                [
                    'name' => 'MODULE-ACTION/CHANGE-STATUS',
                    'route' => 'module_actions.changeStatus',
                ],
                [
                    'name' => 'MODULE-ACTION/EDIT',
                    'route' => 'module_actions.edit',
                ],
                [
                    'name' => 'MODULE-ACTION/UPDATE',
                    'route' => 'module_actions.update',
                ],
                //---------------Rol------------
                [
                    'name' => 'ROLE/INDEX',
                    'route' => 'roles.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-account-card-details',
                    'menu_text' => 'ROLES'
                ],
                [
                    'name' => 'ROLE/CHANGE-STATUS',
                    'route' => 'roles.changeStatus',
                ],
                [
                    'name' => 'ROLE/EDIT',
                    'route' => 'roles.edit',
                ],
                [
                    'name' => 'ROLE/UPDATE',
                    'route' => 'roles.update',
                ],
                [
                    'name' => 'ROLE/CREATE',
                    'route' => 'roles.create',
                ],
                [
                    'name' => 'ROLE/STORE',
                    'route' => 'roles.store',
                ],
                //---------------User------------
                [
                    'name' => 'USER/INDEX',
                    'route' => 'users.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-account',
                    'menu_text' => 'USUARIOS'
                ],
                [
                    'name' => 'USER/EDIT',
                    'route' => 'users.edit',
                ],
                [
                    'name' => 'USER/UPDATE',
                    'route' => 'users.update',
                ],
                [
                    'name' => 'USER/CREATE',
                    'route' => 'users.create',
                ],
                [
                    'name' => 'USER/STORE',
                    'route' => 'users.store',
                ],
            ]
        ],
        'AUDIT' => [
            'menu_text' => 'AUDITORIA',
            'icon_name' => 'mdi mdi-eye',
            'actions' => [
                //---------------Audit------------
                [
                    'name' => 'AUDIT/INDEX',
                    'route' => 'audit_trails.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-routes',
                    'menu_text' => 'PISTAS DE AUDITORIA'
                ],
                [
                    'name' => 'AUDIT/USER-ACTIONS',
                    'route' => 'audit_trails.userActions',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-account-star',
                    'menu_text' => 'ACCIONES DE USUARIO'
                ]
            ]
        ],

        'CUSTOMERS' => [
            'menu_text' => 'CLIENTES',
            'icon_name' => 'mdi mdi-account',
            'actions' => [
                //---------------CUSTOMERS------------
                [
                    'name' => 'CUSTOMERS/INDEX',
                    'route' => 'customers.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi  mdi-account',
                    'menu_text' => 'CLIENTES'
                ],
                [
                    'name' => 'CUSTOMERS/CREATE',
                    'route' => 'customers.create',
                ],
                [
                    'name' => 'CUSTOMERS/STORE',
                    'route' => 'customers.store',
                ],
                [
                    'name' => 'CUSTOMERS/EDIT',
                    'route' => 'customers.edit',
                ],
                [
                    'name' => 'CUSTOMERS/UPDATE',
                    'route' => 'customers.update',
                ],
                [
                    'name' => 'CUSTOMERS/SHOW',
                    'route' => 'customers.show',
                ],
                [
                    'name' => 'CUSTOMERS/DESTROY',
                    'route' => 'customers.destroy',
                ],
                //---------------JOBS------------
                [
                    'name' => 'JOBS/INDEX',
                    'route' => 'job.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi  mdi-tie',
                    'menu_text' => 'TRABAJOS'
                ],
                [
                    'name' => 'JOBS/CREATE',
                    'route' => 'job.create',
                ],
                [
                    'name' => 'JOBS/STORE',
                    'route' => 'job.store',
                ],
                [
                    'name' => 'JOBS/EDIT',
                    'route' => 'job.edit',
                ],
                [
                    'name' => 'JOBS/UPDATE',
                    'route' => 'job.update',
                ],
                [
                    'name' => 'JOBS/DESTROY',
                    'route' => 'job.destroy',
                ],

            ]
        ],
        'INVENTORY' => [
            'menu_text' => 'INVENTARIO',
            'icon_name' => 'mdi mdi-package-variant-closed',
            'actions' => [
                //--------------------WAREHOUSE--------------------
                [
                    'name' => 'WAREHOUSE/INDEX',
                    'route' => 'warehouse.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-home',
                    'menu_text' => 'BODEGAS'
                ],
                [
                    'name' => 'WAREHOUSE/DESTROY',
                    'route' => 'warehouse.destroy',
                ],
                [
                    'name' => 'WAREHOUSE/EDIT',
                    'route' => 'warehouse.edit',
                ],
                [
                    'name' => 'WAREHOUSE/UPDATE',
                    'route' => 'warehouse.update',
                ],
                [
                    'name' => 'WAREHOUSE/CREATE',
                    'route' => 'warehouse.create',
                ],
                [
                    'name' => 'WAREHOUSE/STORE',
                    'route' => 'warehouse.store',
                ],
                //--------------------PRODUCT--------------------
                [
                    'name' => 'PRODUCT/INDEX',
                    'route' => 'product.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-cup-water',
                    'menu_text' => 'PRODUCTOS'
                ],
                [
                    'name' => 'PRODUCT/DESTROY',
                    'route' => 'product.destroy',
                ],
                [
                    'name' => 'PRODUCT/EDIT',
                    'route' => 'product.edit',
                ],
                [
                    'name' => 'PRODUCT/UPDATE',
                    'route' => 'product.update',
                ],
                [
                    'name' => 'PRODUCT/CREATE',
                    'route' => 'product.create',
                ],
                [
                    'name' => 'PRODUCT/STORE',
                    'route' => 'product.store',
                ],
                //------------CATEGORY----------------
                [
                    'name' => 'CATEGORY/INDEX',
                    'route' => 'category.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-format-list-bulleted',
                    'menu_text' => 'CATEGORIAS'
                ],
                [
                    'name' => 'CATEGORY/DESTROY',
                    'route' => 'category.destroy',
                ],
                [
                    'name' => 'CATEGORY/EDIT',
                    'route' => 'category.edit',
                ],
                [
                    'name' => 'CATEGORY/UPDATE',
                    'route' => 'category.update',
                ],
                [
                    'name' => 'CATEGORY/CREATE',
                    'route' => 'category.create',
                ],
                [
                    'name' => 'CATEGORY/STORE',
                    'route' => 'category.store',
                ],
                //----------------PRODUCT-WAREHOUSE--------------------
                [
                    'name' => 'PRODUCT-WAREHOUSE/INDEX',
                    'route' => 'product_warehouse.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-package-variant-closed',
                    'menu_text' => 'PRODUCTOS EN BODEGA'
                ],
                [
                    'name' => 'PRODUCT-WAREHOUSE/DESTROY',
                    'route' => 'product_warehouse.destroy',
                ],
                [
                    'name' => 'PRODUCT-WAREHOUSE/EDIT',
                    'route' => 'product_warehouse.edit',
                ],
                [
                    'name' => 'PRODUCT-WAREHOUSE/UPDATE',
                    'route' => 'product_warehouse.update',
                ],
                [
                    'name' => 'PRODUCT-WAREHOUSE/CREATE',
                    'route' => 'product_warehouse.create',
                ],
                [
                    'name' => 'PRODUCT-WAREHOUSE/STORE',
                    'route' => 'product_warehouse.store',
                ],
                //-------------PRODUCT-MOVEMENT---------------
                [
                    'name' => 'PRODUCT-MOVEMENT/INDEX',
                    'route' => 'product_movement.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-package-variant-closed',
                    'menu_text' => 'MOVIMIENTOS'
                ],
                [
                    'name' => 'PRODUCT-MOVEMENT/EDIT',
                    'route' => 'product_movement.edit',
                ],
                [
                    'name' => 'PRODUCT-MOVEMENT/UPDATE',
                    'route' => 'product_movement.update',
                ],
                [
                    'name' => 'PRODUCT-MOVEMENT/CREATE',
                    'route' => 'product_movement.create',
                ],
                [
                    'name' => 'PRODUCT-MOVEMENT/STORE',
                    'route' => 'product_movement.store',
                ],
                [
                    'name' => 'PRODUCT-MOVEMENT/DESTROY',
                    'route' => 'product_movement.destroy',
                ],
            ]
        ],
        'CUSTOMERS',
        'BILLING',
        'SERVICE ORDERS'
    ];
}
