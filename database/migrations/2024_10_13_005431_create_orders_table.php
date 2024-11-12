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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');  // Relación con clientes
            $table->enum('estado', ['Materia Prima', 'En proceso', 'Acabado'])->default('Materia Prima');
            $table->string('encargado');
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('Pagado', 10, 2)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_entrega');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
