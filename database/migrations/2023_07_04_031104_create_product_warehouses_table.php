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
        Schema::create('product_warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->boolean('status') -> default(1);

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');            
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_warehouses');
    }
};
