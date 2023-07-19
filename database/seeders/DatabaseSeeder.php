<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\DataSeeder;
use Database\Seeders\ModuleAndActionSeeder;
use Database\Seeders\RoleAndActionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ModuleAndActionSeeder::class,
            RoleAndActionSeeder::class,
            DataSeeder::class,
        ]);
    }
}
