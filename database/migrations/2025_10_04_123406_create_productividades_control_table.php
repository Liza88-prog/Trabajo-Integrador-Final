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
        Schema::create('productividad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_control_id'); // Referencia a personal_control
            $table->date('fecha');
            $table->integer('total_conductor')->default(0);
            $table->integer('total_vehiculos')->default(0);
            $table->integer('total_acompanante')->default(0);
            $table->timestamps();

            // 🔗 Relación con tabla personal_control (ajustá el nombre si tu tabla se llama diferente)
            $table->foreign('personal_control_id')
                  ->references('id')
                  ->on('personal_control')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productividad');
    }
};