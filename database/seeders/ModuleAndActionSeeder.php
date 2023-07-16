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
            'menu_text' => 'Seguridad',
            'icon_name' => 'mdi mdi-lock',
            'actions' => [
                //---------------Module------------
                [
                    'name' => 'MODULE/INDEX',
                    'route' => 'modules.index',
                    'displayable_menu' => true,
                    'icon_name' => 'mdi mdi-cube-outline',
                    'menu_text' => 'Modulos'
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
                    'menu_text' => 'Acciones de Modulo'
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
                    'menu_text' => 'Roles'
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
                    'menu_text' => 'Usuarios'
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
        'AUDIT',
        'INVENTORY',
        'CUSTOMERS',
        'BILLING',
        'SERVICE ORDERS'
    ];
}
