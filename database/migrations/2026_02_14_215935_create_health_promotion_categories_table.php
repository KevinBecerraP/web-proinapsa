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
        Schema::create('health_promotion_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            
            // Unique category
            $table->enum('category', [
                'early_childhood',
                'childhood',
                'women',
                'workers'
            ])->unique();
            
            $table->string('display_name', 100);
            $table->string('image');
            $table->string('pdf_file')->nullable();
            
            // Order and status
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            
            // Indexes
            $table->index('area_id');
            $table->index('category');
            $table->index('order');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_promotion_categories');
    }
};