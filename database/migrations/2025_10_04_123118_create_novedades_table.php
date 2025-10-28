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
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('tipo_novedad', 100);
            $table->string('aplica', 100)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // 🔗 Relación con tabla vehiculos (si existe)
            $table->foreign('vehiculo_id')
                  ->references('id')
                  ->on('vehiculo')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
