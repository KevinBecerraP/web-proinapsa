<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->text('formal_education_description')->nullable()->after('description');
            $table->text('non_formal_education_description')->nullable()->after('formal_education_description');
            $table->text('educational_materials_description')->nullable()->after('non_formal_education_description');
            $table->string('educational_materials_image')->nullable()->after('educational_materials_description');
        });
    }

    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn([
                'formal_education_description',
                'non_formal_education_description',
                'educational_materials_description',
                'educational_materials_image',
            ]);
        });
    }
};