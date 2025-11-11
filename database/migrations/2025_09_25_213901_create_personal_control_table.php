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
        Schema::create('personal_control', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido');             // Nombre y apellido
            $table->string('lejago_personal')->unique(); // Legajo personal
            $table->string('dni')->unique();               // DNI
            $table->string('jerarquia')->nullable();       // Jerarquía del agente
            $table->string('rol_en_control')->nullable();  // Rol en el control
            $table->enum('rol_id', ['chofer', 'escopetero', 'planillero', 'encargado']); // Rol del personal en el control
            $table->date('fecha_control');                 // Fecha del control
            $table->time( 'hora_inicio');
            $table->time('hora_fin');      // Horario del control
            $table->string('lugar');                       // Lugar del control
            $table->string('ruta')->nullable();            // Ruta o archivo asociado
            $table->timestamps();                          // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_control');
    }
};