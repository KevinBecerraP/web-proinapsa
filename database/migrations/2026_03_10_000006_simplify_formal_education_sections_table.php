<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formal_education_sections', function (Blueprint $table) {
            // Eliminar la restricción unique de (section, title) si existe
            try {
                $table->dropUnique(['section', 'title']);
            } catch (\Exception $e) {
                // La restricción puede no existir, se ignora
            }

            $table->dropColumn(['title', 'description', 'url']);
        });
    }

    public function down(): void
    {
        Schema::table('formal_education_sections', function (Blueprint $table) {
            $table->string('title', 50)->nullable();
            $table->longText('description')->nullable();
            $table->string('url', 255)->nullable();
        });
    }
};
