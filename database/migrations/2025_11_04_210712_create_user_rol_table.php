<?php
// database/migrations/..._create_user_rol_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_rol', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rol_id')->constrained('roles')->onDelete('cascade');
            $table->primary(['user_id', 'rol_id']); // clave primaria compuesta (opcional, pero recomendada)
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_rol');
    }
};