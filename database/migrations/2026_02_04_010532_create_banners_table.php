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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_color')->default('#000000');
            $table->string('image');
            $table->string('subtitle')->nullable();
            $table->string('subtitle_color')->default('#000000');
            $table->string('button_link')->nullable();
            $table->string('button_color')->nullable();
            $table->boolean('status')->default(true);
            $table->enum('type', ['main', 'secondary'])->default('main');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
