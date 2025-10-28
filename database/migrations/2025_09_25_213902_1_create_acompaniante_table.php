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
        Schema::create('acompaniante', function (Blueprint $table) {
            $table->id(); // ID autoincremental interno

          
            $table->string('Dni_acompañante')->unique();       // DNI del acompañante
            $table->string('Nombre_apellido');                 // Nombre y apellido
            $table->string('Domicilio')->nullable();           // Domicilio
            $table->string('Tipo_acompañante')->nullable();    // Tipo de acompañante (ej: pasajero, copiloto, etc.)

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompaniante');
    }
};