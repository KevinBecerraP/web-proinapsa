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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('values_image')->nullable()->after('methodology_image');
        });

        Schema::table('values', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('values_image');
        });

        Schema::table('values', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
        });
    }
};
