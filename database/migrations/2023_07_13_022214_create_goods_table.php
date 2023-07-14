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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('cost', 8, 2);
            $table->timestamps();
            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');

            $table->unsignedBigInteger('service_order_id');
            $table->foreign('service_order_id')->references('id')->on('service_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
