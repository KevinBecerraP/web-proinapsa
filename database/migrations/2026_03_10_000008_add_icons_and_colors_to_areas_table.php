<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            // Renombrar imagen de materiales a ícono
            $table->renameColumn('educational_materials_image', 'educational_materials_icon');

            // Íconos para educación formal y no formal
            $table->string('formal_education_icon')->nullable()->after('formal_education_description');
            $table->string('non_formal_education_icon')->nullable()->after('non_formal_education_description');

            // Colores de tarjeta para cada subsección
            $table->string('formal_education_color', 20)->nullable()->after('formal_education_icon');
            $table->string('non_formal_education_color', 20)->nullable()->after('non_formal_education_icon');
            $table->string('educational_materials_color', 20)->nullable()->after('educational_materials_icon');
        });
    }

    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('educational_materials_icon', 'educational_materials_image');
            $table->dropColumn([
                'formal_education_icon',
                'non_formal_education_icon',
                'formal_education_color',
                'non_formal_education_color',
                'educational_materials_color',
            ]);
        });
    }
};
