<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('trajectory_title')->nullable()->after('longitude');
            $table->text('trajectory_description')->nullable()->after('trajectory_title');
            $table->string('trajectory_image')->nullable()->after('trajectory_description');
            $table->string('methodology_title')->nullable()->after('trajectory_image');
            $table->longText('methodology_description')->nullable()->after('methodology_title');
            $table->string('methodology_image')->nullable()->after('methodology_description');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'trajectory_title',
                'trajectory_description',
                'trajectory_image',
                'methodology_title',
                'methodology_description',
                'methodology_image',
            ]);
        });
    }
};
