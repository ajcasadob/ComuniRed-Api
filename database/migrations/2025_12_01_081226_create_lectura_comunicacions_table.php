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
        Schema::create('lectura_comunicacions', function (Blueprint $table) {
           
            $table->id();
            $table->foreignId('comunicacion_id')->constrained('comunicacions')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('fecha_lectura')->useCurrent();
            $table->timestamps();
            
            // Evitar duplicados: un usuario solo lee una vez cada comunicación
            $table->unique(['comunicacion_id', 'usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectura_comunicacions');
    }
};
