<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->string('short_description', 300)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('educational_materials', function (Blueprint $table) {
            $table->string('short_description', 200)->nullable()->change();
        });
    }
};
