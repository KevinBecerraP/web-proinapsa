<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\HealthPromotionCategory;
use Illuminate\Database\Seeder;

class HealthPromotionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Social Projection area
        $socialProjectionArea = Area::where('slug', 'proyeccion-social')->first();

        if (!$socialProjectionArea) {
            $this->command->error('❌ No se encontró el área de Proyección Social. Ejecuta primero AreaSeeder.');
            return;
        }

        $categories = [
            [
                'area_id' => $socialProjectionArea->id,
                'category' => 'early_childhood',
                'display_name' => 'Primera Infancia',
                'image' => 'placeholder.jpg', // Placeholder - must be updated from Filament
                'order' => 1,
                'active' => true,
            ],
            [
                'area_id' => $socialProjectionArea->id,
                'category' => 'childhood',
                'display_name' => 'Niñez',
                'image' => 'placeholder.jpg', // Placeholder - must be updated from Filament
                'order' => 2,
                'active' => true,
            ],
            [
                'area_id' => $socialProjectionArea->id,
                'category' => 'women',
                'display_name' => 'Mujer',
                'image' => 'placeholder.jpg', // Placeholder - must be updated from Filament
                'order' => 3,
                'active' => true,
            ],
            [
                'area_id' => $socialProjectionArea->id,
                'category' => 'workers',
                'display_name' => 'Trabajadores',
                'image' => 'placeholder.jpg', // Placeholder - must be updated from Filament
                'order' => 4,
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            HealthPromotionCategory::firstOrCreate(['category' => $category['category']], \Arr::except($category, ['category']));
        }

        $this->command->info('✅ 4 categorías de Promoción de Salud creadas exitosamente.');
    }
}