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
        Schema::create('inventory_ingresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials');
            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2); // Precio por unidad del material ingresado
            $table->decimal('total_price', 10, 2); // Precio total del ingreso (quantity * price_per_unit)
            $table->date('date');
            $table->string('source');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('inventory_ingress_id')->nullable()->constrained('inventory_ingress'); // Relación con ingresos de inventario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_ingresses');
    }
};
