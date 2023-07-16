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
            'MODULE/INDEX',
            'MODULE/CHANGE-STATUS',
            'MODULE-ACTION/INDEX',
            'MODULE-ACTION/CHANGE-STATUS',
            'MODULE-ACTION/EDIT',
            'MODULE-ACTION/UPDATE',
            'ROLE/INDEX',
            'ROLE/CHANGE-STATUS',
            'ROLE/EDIT',
            'ROLE/UPDATE',
            'USER/INDEX',
            'USER/CHANGE-STATUS',
            'USER/EDIT',
            'USER/UPDATE',
            'USER/CREATE',
            'USER/STORE',
        ],
        'AUDITOR',
        'OPERADOR_CLIENTE',
        'OPERADOR_TRABAJO',
        'BODEGUERO_INVENTARIO',
    ];
}
