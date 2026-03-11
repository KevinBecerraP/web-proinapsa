<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educational_material_groups', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['early_childhood', 'school_adolescence']);
            $table->enum('type', ['guides_manuals', 'games']);
            $table->string('title', 100);
            $table->string('image')->nullable();
            $table->string('description', 300)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->unique(['category', 'type']);
            $table->index(['category', 'type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educational_material_groups');
    }
};
