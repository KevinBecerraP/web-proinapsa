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
        // Agregar líneas de investigación al grupo de investigación
        Schema::table('research_group', function (Blueprint $table) {
            $table->string('research_line_1', 100)->nullable()->after('link');
            $table->string('research_line_2', 100)->nullable()->after('research_line_1');
            $table->string('research_line_3', 100)->nullable()->after('research_line_2');
        });

        // Quitar líneas de investigación de publicaciones
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn(['research_line_1', 'research_line_2', 'research_line_3']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->string('research_line_1', 100)->after('status');
            $table->string('research_line_2', 100)->after('research_line_1');
            $table->string('research_line_3', 100)->nullable()->after('research_line_2');
        });

        Schema::table('research_group', function (Blueprint $table) {
            $table->dropColumn(['research_line_1', 'research_line_2', 'research_line_3']);
        });
    }
};
