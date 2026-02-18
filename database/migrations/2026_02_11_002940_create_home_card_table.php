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
        Schema::create('home_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title', 40);
            $table->text('description'); // 200 caracteres (validado en formulario)
            $table->enum('type', ['pdf', 'url']);
            $table->string('file_path')->nullable();
            $table->string('url')->nullable();
            $table->string('button_text', 50)->default('Ver más');
            $table->unsignedInteger('order')->unique();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            // Índices para optimización
            $table->index('estado');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_cards');
    }
};