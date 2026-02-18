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
        Schema::create('educational_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            
            // Classification
            $table->enum('category', ['early_childhood', 'school_adolescence']);
            $table->enum('type', ['guides_manuals', 'games']);
            
            // Preview
            $table->string('title', 50);
            $table->string('short_description', 200);
            $table->string('main_image');
            
            // Full view
            $table->text('full_description'); // Rich Editor
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->string('gallery_image_3')->nullable();
            $table->string('gallery_image_4')->nullable();
            $table->string('gallery_image_5')->nullable();
            $table->string('pdf_file')->nullable();
            
            // Order and status
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
            
            // Constraints
            $table->unique(['category', 'title']);
            
            // Indexes
            $table->index('area_id');
            $table->index('category');
            $table->index('type');
            $table->index('order');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_materials');
    }
};