<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('educational_material_groups', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('icon')->nullable()->after('description');
            $table->string('color', 20)->nullable()->after('icon');
            $table->string('slug')->nullable()->unique()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('educational_material_groups', function (Blueprint $table) {
            $table->dropColumn(['icon', 'color', 'slug']);
            $table->string('image')->nullable();
        });
    }
};
