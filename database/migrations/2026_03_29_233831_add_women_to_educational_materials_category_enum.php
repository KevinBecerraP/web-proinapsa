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
        DB::statement("ALTER TABLE educational_materials MODIFY COLUMN category ENUM('early_childhood', 'school_adolescence', 'women', 'childhood', 'workers') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE educational_materials MODIFY COLUMN category ENUM('early_childhood', 'school_adolescence') NOT NULL");
    }
};
