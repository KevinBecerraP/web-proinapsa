<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Crear la nueva tabla research_lines
        Schema::create('research_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_group_id')
                ->constrained('research_group')
                ->cascadeOnDelete();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('order');
            $table->index('active');
        });

        // 2. Migrar datos existentes de research_line_1/2/3 → research_lines
        $groups = DB::table('research_group')->get();
        foreach ($groups as $group) {
            $order = 1;
            foreach (['research_line_1', 'research_line_2', 'research_line_3'] as $field) {
                if (!empty($group->$field)) {
                    DB::table('research_lines')->insert([
                        'research_group_id' => $group->id,
                        'title'             => $group->$field,
                        'order'             => $order++,
                        'active'            => true,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }
            }
        }

        // 3. Eliminar columnas antiguas de research_group
        Schema::table('research_group', function (Blueprint $table) {
            $table->dropColumn(['research_line_1', 'research_line_2', 'research_line_3']);
        });
    }

    public function down(): void
    {
        // Restaurar columnas en research_group
        Schema::table('research_group', function (Blueprint $table) {
            $table->string('research_line_1', 100)->nullable();
            $table->string('research_line_2', 100)->nullable();
            $table->string('research_line_3', 100)->nullable();
        });

        // Migrar datos de vuelta (solo los primeros 3 por grupo)
        $lines = DB::table('research_lines')->orderBy('research_group_id')->orderBy('order')->get();
        $grouped = [];
        foreach ($lines as $line) {
            $grouped[$line->research_group_id][] = $line->title;
        }
        foreach ($grouped as $groupId => $titles) {
            DB::table('research_group')->where('id', $groupId)->update([
                'research_line_1' => $titles[0] ?? null,
                'research_line_2' => $titles[1] ?? null,
                'research_line_3' => $titles[2] ?? null,
            ]);
        }

        Schema::dropIfExists('research_lines');
    }
};
