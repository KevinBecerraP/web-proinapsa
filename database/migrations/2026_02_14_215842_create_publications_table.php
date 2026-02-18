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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            
            // Content
            $table->string('title', 50)->unique();
            $table->string('subtitle', 100)->nullable();
            $table->string('short_description', 300);
            $table->string('image');
            $table->string('external_link');
            
            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            // Research lines
            $table->string('research_line_1', 100);
            $table->string('research_line_2', 100);
            $table->string('research_line_3', 100)->nullable();
            
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
        Schema::dropIfExists('publications');
    }
};
