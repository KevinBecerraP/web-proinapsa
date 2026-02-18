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
        Schema::create('formal_education_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            
            // Section type
            $table->enum('section', [
                'generalities',
                'modalities',
                'procedures',
                'intern_commitments',
                'institute_commitments'
            ]);
            
            // Content
            $table->string('title', 50);
            $table->text('description'); // Rich Editor
            $table->string('image')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('url')->nullable();
            
            // Order and status
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
            
            // Constraints
            $table->unique(['section', 'title']);
            
            // Indexes
            $table->index('area_id');
            $table->index('section');
            $table->index('order');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_education_sections');
    }
};