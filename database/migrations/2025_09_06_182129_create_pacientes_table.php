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
            $table->string('nombre');
            $table->string('apellido', 50);
            $table->string('tipo_identificacion');
            $table->integer('numero_identificacion');
            $table->date('fecha_nacimiento');
            $table->string('genero', 20);
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('telefono', 250)->nullable();
            $table->string('email');
            $table->string('tipo_afiliacion');
            $table->integer('num_historial_medico');
            $table->string('pais');
            $table->string('departamento');
            $table->string('eps');
            $table->string('ocupacion');
            $table->string('discapacidad')->nullable();
            $table->string('subsidiaria');
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
