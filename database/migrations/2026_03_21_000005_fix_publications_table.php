<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Corregir area_id de todas las publicaciones
        $areaId = DB::table('areas')->where('slug', 'investigacion')->value('id');
        if ($areaId) {
            DB::table('publications')->update(['area_id' => $areaId]);
        }

        // Truncar descripciones existentes que superen 150 caracteres
        DB::statement('UPDATE publications SET short_description = LEFT(short_description, 150)');

        // Ajustar short_description a 150 chars y eliminar subtitle
        Schema::table('publications', function (Blueprint $table) {
            $table->string('short_description', 150)->change();
            $table->dropColumn('subtitle');
        });
    }

    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->string('short_description', 300)->change();
            $table->string('subtitle', 100)->nullable()->after('title');
        });
    }
};
