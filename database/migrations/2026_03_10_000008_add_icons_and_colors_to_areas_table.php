<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            // Imágenes para educación formal y no formal
            $table->string('formal_education_image')->nullable()->after('formal_education_description');
            $table->string('non_formal_education_image')->nullable()->after('non_formal_education_description');

            // Colores de tarjeta para cada subsección
            $table->string('formal_education_color', 20)->nullable()->after('formal_education_image');
            $table->string('non_formal_education_color', 20)->nullable()->after('non_formal_education_image');
            $table->string('educational_materials_color', 20)->nullable()->after('educational_materials_image');
        });
    }

    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn([
                'formal_education_image',
                'non_formal_education_image',
                'formal_education_color',
                'non_formal_education_color',
                'educational_materials_color',
            ]);
        });
    }
};
