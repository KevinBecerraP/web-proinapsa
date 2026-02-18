<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repository_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repository_category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('authors')->nullable();
            $table->string('topic')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('document')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repository_documents');
    }
};