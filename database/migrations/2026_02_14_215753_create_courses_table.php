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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            
            // Preview
            $table->string('title', 50)->unique();
            $table->string('short_description', 200);
            $table->string('main_image');
            
            // Full view
            $table->text('full_description'); // Rich Editor
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->string('gallery_image_3')->nullable();
            $table->string('pdf_file')->nullable();
            
            // Additional
            $table->enum('status', ['active', 'finished', 'inactive'])->default('active');
            $table->string('registration_link');
            $table->unsignedInteger('duration_hours')->nullable();
            
            // Order
            $table->unsignedInteger('order')->default(1);
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes
            $table->index('area_id');
            $table->index('status');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};