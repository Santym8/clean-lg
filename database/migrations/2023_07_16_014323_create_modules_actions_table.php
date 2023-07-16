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
        Schema::create('module_actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50)->unique();
            $table->string('route', 50)->unique();
            $table->boolean('displayable_menu')->default(false);
            $table->string('icon_name', 50)->nullable();
            $table->boolean('status')->default(true);
            $table->string('menu_text', 50)->nullable();
            $table->foreignId('module_id')->constrained('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_actions');
    }
};
