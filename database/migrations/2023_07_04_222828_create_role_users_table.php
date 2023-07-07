<?php

use App\Models\security\Role;
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
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // -------------Asignation all Roles to Admin----------------
        $roles = Role::all();
        foreach ($roles as $role) {
            DB::table('role_user')->insert([
                'role_id' => $role->id,
                'user_id' => 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
