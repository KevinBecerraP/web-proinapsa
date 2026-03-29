<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
        });

        // Generar slugs para registros existentes
        \DB::table('teams')->get()->each(function ($team) {
            $slug = Str::slug($team->name);
            $original = $slug;
            $i = 1;
            while (\DB::table('teams')->where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $original . '-' . $i++;
            }
            \DB::table('teams')->where('id', $team->id)->update(['slug' => $slug]);
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
