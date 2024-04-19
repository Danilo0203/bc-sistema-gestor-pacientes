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
        Schema::create('datos_medicos_paciente', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');

            $table->foreignId('dato_medico_id')->constrained('datos_medicos');
            $table->foreignId('paciente_id')->constrained('pacientes');

            $table->string('valor', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_medicos_paciente');
    }
};
