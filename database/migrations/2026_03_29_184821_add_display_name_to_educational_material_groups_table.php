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
        Schema::table('educational_material_groups', function (Blueprint $table) {
            $table->string('display_name')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('educational_material_groups', function (Blueprint $table) {
            $table->dropColumn('display_name');
        });
    }
};
