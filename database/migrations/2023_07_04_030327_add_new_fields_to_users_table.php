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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name');
            $table->string('identification_type');
            $table->string('identification')->unique();
            $table->string('phone_number')->unique();
            $table->boolean('status')->default(1);
        });

        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'identification_type' => 'CEDULA',
            'identification' => 'admin',
            'phone_number' => 'none',
            'status' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'identification_type', 'identification', 'phone_number', 'status']);
        });
    }
};
