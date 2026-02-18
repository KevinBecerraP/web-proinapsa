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
        Schema::table('companies', function (Blueprint $table) {
            // Eliminar campos de misión extras
            $table->dropColumn(['mission_image_2', 'mission_image_3']);
            
            // Renombrar mission_image_1 a mission_image
            $table->renameColumn('mission_image_1', 'mission_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Restaurar columnas
            $table->renameColumn('mission_image', 'mission_image_1');
            $table->string('mission_image_2')->nullable();
            $table->string('mission_image_3')->nullable();
        });
    }
};
