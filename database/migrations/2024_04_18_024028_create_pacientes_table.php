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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->date('fecha_nacimiento');

            $table->foreignId('genero_id')->constrained('generos');
            $table->foreignId('estado_civil_id')->constrained('estado_civil');
            $table->foreignId('profesion_id')->constrained('profesiones');
            $table->foreignId('direccion_id')->constrained('direcciones');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
