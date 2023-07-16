<?php

namespace Database\Seeders;

use App\Models\security\Module;
use App\Models\security\SecModuleAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecuritySeeder extends Seeder
{

    public function run(): void
    {
        foreach ($this->moduleAndActionsList as $moduleName => $actions) {
            $createdModule = Module::create([
                'name' => $moduleName,
            ]);

            if (is_array($actions)) {
                foreach ($actions as $action) {
                    SecModuleAction::create(
                        $action + ['module_id' => $createdModule->id]
                    );
                }
            }
        }
    }

    private $moduleAndActionsList = [
        'SECURITY' => [
            [
                'name' => 'ROL INDEX',
                'route' => 'roles.index',
                'displayable_menu' => true,
                'icon_name' => 'fas fa-user-tag',
            ],
            [
                'name' => 'Rol Change Status',
                'route' => 'roles.changeStatus',
            ],
        ],
        'AUDIT',
        'INVENTORY',
        'CUSTOMERS',
        'BILLING',
        'SERVICE ORDERS'
    ];
}
