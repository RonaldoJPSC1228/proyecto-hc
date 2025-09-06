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
        Schema::create('historia_clinicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->date('fecha')->nullable();
            $table->text('motivo_consulta')->nullable();
            $table->text('antecedentes')->nullable();
            $table->text('sintomas')->nullable();
            $table->text('diagnostico_presuntivo')->nullable();
            $table->json('evidencias')->nullable(); // Para logs/explicabilidad IA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_clinicas');
    }
};
