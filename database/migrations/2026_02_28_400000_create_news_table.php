<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('excerpt', 300);
            $table->longText('content');
            $table->string('image');
            $table->unsignedInteger('order')->default(1);
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('order');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
