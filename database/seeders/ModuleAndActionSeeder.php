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

        'INVENTORY',
        'CUSTOMERS',
        'BILLING',
        'SERVICE_ORDERS' => [
            'menu_text' => 'ORDENES DE SERVICIO',
            'icon_name' => 'mdi mdi-clipboard-text',
            'actions' => [
                //---------------Service Order------------
                [
                    'name' => 'SERVICE_ORDERS/INDEX',
                    'route' => 'service_orders.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-file-document',
                    'menu_text' => 'ORDENES DE SERVICIO'
                ],
                [
                    'name' => 'SERVICE_ORDERS/EDIT',
                    'route' => 'service_orders.edit',
                ],
                [
                    'name' => 'SERVICE_ORDERS/UPDATE',
                    'route' => 'service_orders.update',
                ],
                [
                    'name' => 'SERVICE_ORDERS/CREATE',
                    'route' => 'service_orders.create',
                ],
                [
                    'name' => 'SERVICE_ORDERS/STORE',
                    'route' => 'service_orders.store',
                ],
                [
                    'name' => 'SERVICE_ORDERS/SHOW',
                    'route' => 'service_orders.show',
                ],
                [
                    'name' => 'SERVICE_ORDERS/DELETE',
                    'route' => 'service_orders.destroy',
                ],
               
                //---------------Services--------------
                [
                    'name' => 'SERVICES/INDEX',
                    'route' => 'services.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-file-document',
                    'menu_text' => 'SERVICIOS'
                ],
                [
                    'name' => 'SERVICES/EDIT',
                    'route' => 'services.edit',
                ],
                [
                    'name' => 'SERVICES/UPDATE',
                    'route' => 'services.update',
                ],
                [
                    'name' => 'SERVICES/CREATE',
                    'route' => 'services.create',
                ],
                [
                    'name' => 'SERVICES/STORE',
                    'route' => 'services.store',
                ],
                [
                    'name' => 'SERVICES/SHOW',
                    'route' => 'services.show',
                ],
                [
                    'name' => 'SERVICES/DELETE',
                    'route' => 'services.destroy',
                ],

                //-----------------Goods-------------
                [
                    'name' => 'GOODS/INDEX',
                    'route' => 'goods.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mmdi mdi-file-document',
                    'menu_text' => 'BIENES'
                ],
                [
                    'name' => 'GOODS/EDIT',
                    'route' => 'goods.edit',
                ],
                [
                    'name' => 'GOODS/UPDATE',
                    'route' => 'goods.update',
                ],
                [
                    'name' => 'GOODS/CREATE',
                    'route' => 'goods.create',
                ],
                [
                    'name' => 'GOODS/STORE',
                    'route' => 'goods.store',
                ],
                [
                    'name' => 'GOODS/SHOW',
                    'route' => 'goods.show',
                ],
                [
                    'name' => 'GOODS/DELETE',
                    'route' => 'goods.destroy',
                ],

                //-----------------SERVICE_ORDERS_GOODS-----------
                [
                    'name' => 'SERVICE_ORDERS_GOODS/INDEX',
                    'route' => 'service_orders_goods.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-file-document',
                    'menu_text' => 'ORDENES DE SERVICIO - BIENES'
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/EDIT',
                    'route' => 'service_orders_goods.edit',
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/UPDATE',
                    'route' => 'service_orders_goods.update',
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/CREATE',
                    'route' => 'service_orders_goods.create',
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/STORE',
                    'route' => 'service_orders_goods.store',
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/SHOW',
                    'route' => 'service_orders_goods.show',
                ],
                [
                    'name' => 'SERVICE_ORDERS_GOODS/DELETE',
                    'route' => 'service_orders_goods.destroy',
                ],

            ]
        ]
    ];
}
