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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->string('ubicacion', 200)->nullable();
            $table->string('categoria', 30); // fontaneria, electricidad, ascensor, limpieza, otros
            $table->string('estado', 20)->default('pendiente'); // pendiente, en_progreso, resuelta
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('vivienda_id')->nullable()->constrained('viviendas')->nullOnDelete();
            $table->timestamp('fecha_resolucion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
