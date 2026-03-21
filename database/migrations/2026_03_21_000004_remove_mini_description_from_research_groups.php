<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('research_group', function (Blueprint $table) {
            $table->dropColumn('mini_description');
        });
    }

    public function down(): void
    {
        Schema::table('research_group', function (Blueprint $table) {
            $table->string('mini_description', 300)->after('name');
        });
    }
};
