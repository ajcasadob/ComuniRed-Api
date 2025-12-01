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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->constrained('viviendas')->cascadeOnDelete();
            $table->string('concepto', 200); // Cuota mensual, Derrama, etc
            $table->string('periodo', 20)->nullable(); // 2025-01
            $table->decimal('importe', 10, 2);
            $table->string('estado', 20)->default('pendiente'); // pendiente, pagado
            $table->date('fecha_vencimiento');
            $table->date('fecha_pago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
