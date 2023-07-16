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
        foreach ($this->moduleAndActionsList as $moduleName => $actions) {
            $createdModule = Module::create([
                'name' => $moduleName,
            ]);

            if (is_array($actions)) {
                foreach ($actions as $action) {
                    ModuleAction::create(
                        $action + ['module_id' => $createdModule->id]
                    );
                }
            }
        }
    }

    private $moduleAndActionsList = [
        'SECURITY' => [
            //---------------Module------------
            [
                'name' => 'MODULE/INDEX',
                'route' => 'modules.index',
                'displayable_menu' => true,
                'icon_name' => 'fas fa-cubes',
                'menu_text' => 'Modulos'
            ],
            [
                'name' => 'MODULE/CHANGE-STATUS',
                'route' => 'modules.changeStatus',
            ],
            //---------------Module Action------------
            [
                'name' => 'MODULE-ACTION/INDEX',
                'route' => 'module_actions.index',
                'displayable_menu' => true,
                'icon_name' => 'fas fa-cube',
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
                'icon_name' => 'fas fa-user-tag',
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
            //---------------User------------
            [
                'name' => 'USER/INDEX',
                'route' => 'users.index',
                'displayable_menu' => true,
                'icon_name' => 'fas fa-users',
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
        ],
        'AUDIT',
        'INVENTORY',
        'CUSTOMERS',
        'BILLING',
        'SERVICE ORDERS'
    ];
}
