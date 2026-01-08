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
        Schema::create('comunicacions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('contenido');
            $table->string('tipo', 30); 
            $table->foreignId('autor_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('fecha_publicacion')->useCurrent();
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunicacions');
    }
};
