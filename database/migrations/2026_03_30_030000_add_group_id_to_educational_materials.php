<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Agregar columna group_id (nullable primero para poder poblarla)
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable()->after('area_id');
        });

        // 2. Poblar group_id a partir del valor de category
        $groups = DB::table('educational_material_groups')->get();
        foreach ($groups as $group) {
            DB::table('educational_materials')
                ->where('category', $group->category)
                ->update(['group_id' => $group->id]);
        }

        // 3. Hacer group_id NOT NULL y agregar FK
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable(false)->change();
            $table->foreign('group_id')
                  ->references('id')
                  ->on('educational_material_groups')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }
};
