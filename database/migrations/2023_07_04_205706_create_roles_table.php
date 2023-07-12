<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50)->unique();
            $table->boolean('status')->default(true);
        });

        // ---------------System Roles----------------
        $roles = [
            [
                'name' => 'ADMINSTRADOR_DE_SISTEMA',
            ],
            [
                'name' => 'AUDITOR',
            ],
            [
                'name' => 'OPERADOR_CLIENTE',
            ],
            [
                'name' => 'OPERADOR_TRABAJO',
            ],
            [
                'name' => 'BODEGUERO_INVENTARIO',
            ],
            [
                'name' => 'OPERADOR_SERVICIOS',
            ],
        ];

        // Insert roles
        DB::table('roles')->insert($roles);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
