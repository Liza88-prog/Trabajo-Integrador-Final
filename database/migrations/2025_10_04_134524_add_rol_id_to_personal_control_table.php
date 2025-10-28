<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_control', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id')->nullable()->after('rol_en_control');

            // 🔗 Clave foránea a tabla roles
            $table->foreign('rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('personal_control', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropColumn('rol_id');
        });
    }
};