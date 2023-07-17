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
        ],
        'AUDITOR' => [
            'AUDIT/INDEX',
            'AUDIT/USER-ACTIONS'
        ],
        'OPERADOR_CLIENTE',
        'OPERADOR_TRABAJO',
        'BODEGUERO_INVENTARIO'=>[
            //WAREHOUSE
            'WAREHOUSE/INDEX',
            'WAREHOUSE/EDIT',
            'WAREHOUSE/UPDATE',
            'WAREHOUSE/CREATE',
            'WAREHOUSE/STORE',
            'WAREHOUSE/DESTROY',
            //PRODUCT
            'PRODUCT/INDEX',
            'PRODUCT/EDIT',
            'PRODUCT/UPDATE',
            'PRODUCT/CREATE',
            'PRODUCT/STORE',
            'PRODUCT/DESTROY',
            //CATEGORY
            'CATEGORY/INDEX',
            'CATEGORY/EDIT',
            'CATEGORY/UPDATE',
            'CATEGORY/CREATE',
            'CATEGORY/STORE',
            'CATEGORY/DESTROY',
            //PRODUCT-WAREHOUSE
            'PRODUCT-WAREHOUSE/INDEX',
            'PRODUCT-WAREHOUSE/EDIT',
            'PRODUCT-WAREHOUSE/UPDATE',
            'PRODUCT-WAREHOUSE/CREATE',
            'PRODUCT-WAREHOUSE/STORE',
            'PRODUCT-WAREHOUSE/DESTROY',
        ],
    ];
}
