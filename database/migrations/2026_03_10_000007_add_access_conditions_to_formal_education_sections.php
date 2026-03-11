<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ampliar el enum para incluir 'access_conditions'
        DB::statement("ALTER TABLE formal_education_sections MODIFY COLUMN section ENUM('generalities','modalities','procedures','access_conditions','intern_commitments','institute_commitments') NOT NULL");

        // Eliminar registros duplicados o con section vacía antes de agregar el unique
        DB::statement("
            DELETE t1 FROM formal_education_sections t1
            INNER JOIN formal_education_sections t2
            WHERE t1.id > t2.id AND t1.section = t2.section
        ");

        // Verificar si el unique ya existe antes de crearlo
        $indexExists = collect(DB::select("SHOW INDEX FROM formal_education_sections WHERE Key_name = 'formal_education_sections_section_unique'"))->isNotEmpty();

        if (!$indexExists) {
            Schema::table('formal_education_sections', function (Blueprint $table) {
                $table->unique('section', 'formal_education_sections_section_unique');
            });
        }
    }

    public function down(): void
    {
        Schema::table('formal_education_sections', function (Blueprint $table) {
            $table->dropUnique('formal_education_sections_section_unique');
        });

        DB::statement("ALTER TABLE formal_education_sections MODIFY COLUMN section ENUM('generalities','modalities','procedures','intern_commitments','institute_commitments') NOT NULL");
    }
};
