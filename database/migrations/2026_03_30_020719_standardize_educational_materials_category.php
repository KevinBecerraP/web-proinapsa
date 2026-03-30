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
        // Migrar registros de school_adolescence a childhood
        DB::table('educational_materials')
            ->where('category', 'school_adolescence')
            ->update(['category' => 'childhood']);

        // Estandarizar ENUM (quitar school_adolescence, agregar display_name)
        DB::statement("ALTER TABLE educational_materials
            MODIFY COLUMN category ENUM('early_childhood','childhood','women','workers') NOT NULL");

        Schema::table('educational_materials', function (Blueprint $table) {
            $table->string('display_name', 100)->nullable()->after('category');
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE educational_materials
            MODIFY COLUMN category ENUM('early_childhood','school_adolescence','women','childhood','workers') NOT NULL");

        Schema::table('educational_materials', function (Blueprint $table) {
            $table->dropColumn('display_name');
        });
    }
};
