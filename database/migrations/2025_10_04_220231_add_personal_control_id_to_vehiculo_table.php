<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehiculo', function (Blueprint $table) {
            $table->unsignedBigInteger('personal_control_id')->nullable()->after('id');

            $table->foreign('personal_control_id')
                  ->references('id')
                  ->on('personal_control')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('vehiculo', function (Blueprint $table) {
            $table->dropForeign(['personal_control_id']);
            $table->dropColumn('personal_control_id');
        });
    }
};
