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
        Schema::create('institutional_resources', function (Blueprint $table) {
            $table->id();
            
            // Type
            $table->enum('type', ['interest_link', 'partner']);
            
            // Content for interest_link
            $table->string('title', 100)->nullable(); // For interest links
            $table->string('url')->nullable(); // For interest links
            
            // Content for partner
            $table->string('name', 100)->nullable(); // For partners
            $table->string('image')->nullable(); // For partners
            
            // Order and status
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes
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
        Schema::dropIfExists('institutional_resources');
    }
};