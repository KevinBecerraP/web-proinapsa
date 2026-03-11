<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('formal_education_icon', 'formal_education_image');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('non_formal_education_icon', 'non_formal_education_image');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('educational_materials_icon', 'educational_materials_image');
        });
    }

    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('formal_education_image', 'formal_education_icon');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('non_formal_education_image', 'non_formal_education_icon');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->renameColumn('educational_materials_image', 'educational_materials_icon');
        });
    }
};
