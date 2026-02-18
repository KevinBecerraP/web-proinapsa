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
            // Agregar campos de Misión
            $table->string('mission_title');
            $table->text('mission_description');
            $table->string('mission_image_1');
            $table->string('mission_image_2')->nullable();
            $table->string('mission_image_3')->nullable();
            
            // Agregar campos de Visión
            $table->string('vision_title');
            $table->text('vision_description');
            $table->string('vision_image');
            
            // Eliminar campo status
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Eliminar campos de Misión
            $table->dropColumn([
                'mission_title',
                'mission_description',
                'mission_image_1',
                'mission_image_2',
                'mission_image_3',
            ]);
            
            // Eliminar campos de Visión
            $table->dropColumn([
                'vision_title',
                'vision_description',
                'vision_image',
            ]);
            
            // Restaurar campo status
            $table->boolean('status')->default(true);
        });
    }
};