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
        Schema::create('acceso_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->nullable()->constrained('viviendas')->nullOnDelete();
            $table->string('tipo_acceso', 20); // vehicular, peatonal
            $table->string('nombre_visitante', 150)->nullable();
            $table->string('matricula', 20)->nullable();
            $table->timestamp('fecha_hora_entrada')->useCurrent();
            $table->timestamp('fecha_hora_salida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceso_controls');
    }
};
