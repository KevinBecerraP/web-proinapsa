<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Educación y Comunicación',
                'slug' => 'educacion-comunicacion',
                'description' => 'Área dedicada a la educación formal, no formal y materiales educativos.',
                'icon' => 'heroicon-o-academic-cap',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Investigación',
                'slug' => 'investigacion',
                'description' => 'Área dedicada a publicaciones y grupos de investigación.',
                'icon' => 'heroicon-o-beaker',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Proyección Social',
                'slug' => 'proyeccion-social',
                'description' => 'Área dedicada a la promoción de la salud en diferentes grupos poblacionales.',
                'icon' => 'heroicon-o-heart',
                'order' => 3,
                'active' => true,
            ],
        ];

        foreach ($areas as $area) {
            Area::firstOrCreate(['slug' => $area['slug']], \Arr::except($area, ['slug']));
        }
    }
}