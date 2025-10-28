<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // 🔹 Forzar InnoDB
            $table->id();

            $table->unsignedBigInteger('conductor_id')->nullable();
            $table->dateTime('fecha_hora_control');
            $table->string('marca_modelo');
            $table->string('dominio')->unique();
            $table->string('color')->nullable();

            $table->timestamps();

            // 🔹 Foreign key al conductor
            $table->foreign('conductor_id')
                  ->references('id')
                  ->on('conductor')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};