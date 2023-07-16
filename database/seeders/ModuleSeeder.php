<?php

namespace Database\Seeders;

use App\Models\security\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{

    private $moduleList = ['SECURITY', 'AUDIT', 'INVENTORY', 'CUSTOMERS', 'BILLING', 'SERVICE ORDERS'];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->moduleList as $module) {
            Module::create([
                'name' => $module,
            ]);
        }
    }
}
