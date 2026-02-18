<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // IMPORTANTE: Los seeders se ejecutan en orden
        
        // 1. Primero crear las áreas (requerido por otros seeders)
        $this->call([
            AreaSeeder::class,
        ]);

        // 2. Luego crear las categorías de promoción de salud
        $this->call([
            HealthPromotionCategorySeeder::class,
        ]);

        $this->command->info('🎉 Todos los seeders ejecutados exitosamente!');
    }
}