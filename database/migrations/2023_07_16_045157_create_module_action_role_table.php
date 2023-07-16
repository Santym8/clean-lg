<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module_action_role', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('module_action_id')->constrained('module_actions');
            $table->foreignId('role_id')->constrained('roles');
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_action_role');
    }
};
