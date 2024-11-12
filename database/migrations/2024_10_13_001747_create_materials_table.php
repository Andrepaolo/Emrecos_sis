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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mcategory_id');
            $table->string('name');
            $table->unsignedBigInteger('unit_id');  // Relación con unidades de medida
            $table->decimal('precio_unidad', 10, 2);
            $table->decimal('stock', 10, 2)->default(0);
            $table->foreign('unit_id')->references('id')->on('units'); // Asegúrate que la tabla `units` exista
            $table->foreign('mcategory_id')->references('id')->on('mcategories'); // Relación con mcategories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
