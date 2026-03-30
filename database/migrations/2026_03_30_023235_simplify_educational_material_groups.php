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
        // 1. Expandir ENUM para incluir todos los valores (viejos + nuevos)
        DB::statement("ALTER TABLE educational_material_groups
            MODIFY COLUMN category ENUM('early_childhood','school_adolescence','childhood','women','workers') NOT NULL");

        // 2. Migrar datos
        DB::table('educational_material_groups')
            ->where('category', 'school_adolescence')
            ->update(['category' => 'childhood']);

        // 3. Dejar solo los 4 valores definitivos
        DB::statement("ALTER TABLE educational_material_groups
            MODIFY COLUMN category ENUM('early_childhood','childhood','women','workers') NOT NULL");

        // Eliminar duplicados (dejar solo uno por categoría: el de menor id)
        $categories = ['early_childhood', 'childhood', 'women', 'workers'];
        foreach ($categories as $cat) {
            $ids = DB::table('educational_material_groups')
                ->where('category', $cat)
                ->orderBy('id')
                ->pluck('id');
            if ($ids->count() > 1) {
                DB::table('educational_material_groups')
                    ->whereIn('id', $ids->slice(1)->values())
                    ->delete();
            }
        }

        // 3. Crear grupos faltantes para categorías sin registro
        $existing = DB::table('educational_material_groups')->pluck('category')->toArray();
        $defaults = [
            'women'   => ['title' => 'Mujer',           'display_name' => 'Mujer',                        'order' => 3],
            'workers' => ['title' => 'Trabajadores',     'display_name' => 'Trabajadores',                 'order' => 4],
        ];
        foreach ($defaults as $cat => $data) {
            if (!in_array($cat, $existing)) {
                DB::table('educational_material_groups')->insert([
                    'category'     => $cat,
                    'display_name' => $data['display_name'],
                    'title'        => $data['title'],
                    'slug'         => \Illuminate\Support\Str::slug($data['title']),
                    'is_active'    => true,
                    'order'        => $data['order'],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }

        // 4. Eliminar display_name de educational_materials
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->dropColumn('display_name');
        });
    }

    public function down(): void
    {
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->string('display_name', 100)->nullable()->after('category');
        });
    }
};
