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
        'CUSTOMERS'=> [
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
        'BILLING',
        'SERVICE ORDERS'
    ];
}
