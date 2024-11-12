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
        Schema::create('inventory_egresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials'); // Relación con la tabla de Material
            $table->integer('quantity');
            $table->date('date');
            $table->string('destination'); // Destino del egreso, puede ser producción, desecho, etc.
            $table->string('cliente')->nullable();
            $table->string('responsable')->nullable();
            $table->string('observaciones')->nullable();


            $table->foreignId('user_id')->nullable()->constrained('users'); // Usuario que realizó el egreso
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_egresses');
    }
};
