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
        Schema::table('personal_control', function (Blueprint $table) {
            // 🔹 Eliminamos la columna antigua
            $table->dropColumn('horario_control');

            // 🔹 Creamos las nuevas columnas
            $table->time('hora_inicio')->after('fecha_control');
            $table->time('hora_fin')->after('hora_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_control', function (Blueprint $table) {
            // 🔹 Revertimos los cambios
            $table->string('horario_control', 50)->after('fecha_control');
            $table->dropColumn(['hora_inicio', 'hora_fin']);
        });
    }
};