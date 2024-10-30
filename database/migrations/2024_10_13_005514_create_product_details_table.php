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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('preciounit', 10, 2);
            $table->decimal('total_material', 10, 2);
            $table->foreign('step_id')->references('id')->on('steps');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
