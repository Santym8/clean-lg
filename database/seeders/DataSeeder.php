<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //INVENTORY
        DB::table('categories')->insert(
            [
                ['name' => 'JABONES'],
                ['name' => 'DETERGENTES'],
                ['name' => 'ALCOHOL'],
                ['name' => 'MASCARILLAS'],
                ['name' => 'GUANTES'],
                ['name' => 'OTROS'],
            ]
        );

        // Products
        DB::table('products')->insert([
            ['name' => 'AZUL', 'category_id' => 1],
            ['name' => 'DEJA', 'category_id' => 2],
            ['name' => 'GUANTES NEGROS DE CAUCHO', 'category_id' => 5],

        ]);

        // Warehouse
        DB::table('warehouses')->insert([
            ['name' => 'BODEGA SAN GABRIEL'],
            ['name' => 'BODEGA IBARRA'],
            ['name' => 'BODEGA TULCAN'],
        ]);

        // Products - Warehouse
        DB::table('product_warehouses')->insert([
            ['product_id' => 1, 'warehouse_id' => 1, 'stock' => 10],
            ['product_id' => 1, 'warehouse_id' => 2, 'stock' => 5],
            ['product_id' => 1, 'warehouse_id' => 3, 'stock' => 13],
            ['product_id' => 2, 'warehouse_id' => 1, 'stock' => 6],
            ['product_id' => 2, 'warehouse_id' => 2, 'stock' => 3],
            ['product_id' => 2, 'warehouse_id' => 3, 'stock' => 6],
        ]);


        // Services
        DB::table('services')->insert([
            ['name' => 'LAVADO EN SECO PANTALON', 'cost' => 3.50],
            ['name' => 'LAVADO EN HUMEDO PANTALON', 'cost' => 2],
            ['name' => 'LAVADO EN SECO CHAQUETA', 'cost' => 6],
            ['name' => 'LAVADO EN HUMEDO CHAQUETA', 'cost' => 4.50],
        ]);


        // JOBS
        DB::table('jobs')->insert([
            ['name' => 'ABOGADO'],
            ['name' => 'MEDICO'],
            ['name' => 'CONTADOR'],
            ['name' => 'PROFESOR'],
        ]);
    }
}
