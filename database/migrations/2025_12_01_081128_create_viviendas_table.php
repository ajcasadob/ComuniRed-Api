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
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_vivienda', 10)->unique();
            $table->string('bloque', 10)->nullable();
            $table->string('piso', 10)->nullable();
            $table->string('puerta', 10)->nullable();
            $table->decimal('metros_cuadrados', 7, 2)->nullable();
            $table->string('tipo', 20); // piso, local, garaje
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viviendas');
    }
};
