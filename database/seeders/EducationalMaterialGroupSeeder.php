<?php

namespace Database\Seeders;

use App\Models\EducationalMaterialGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EducationalMaterialGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            [
                'category'    => 'early_childhood',
                'type'        => 'guides_manuals',
                'title'       => 'Guías y Manuales — Primera Infancia',
                'slug'        => Str::slug('Guias y Manuales Primera Infancia'),
                'description' => 'Guías y manuales educativos dirigidos a la primera infancia.',
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'category'    => 'early_childhood',
                'type'        => 'games',
                'title'       => 'Juegos — Primera Infancia',
                'slug'        => Str::slug('Juegos Primera Infancia'),
                'description' => 'Juegos y actividades lúdicas para el desarrollo de la primera infancia.',
                'order'       => 2,
                'is_active'   => true,
            ],
            [
                'category'    => 'school_adolescence',
                'type'        => 'guides_manuals',
                'title'       => 'Guías y Manuales — Escolar y Adolescencia',
                'slug'        => Str::slug('Guias y Manuales Escolar y Adolescencia'),
                'description' => 'Guías y manuales educativos para la población escolar y adolescente.',
                'order'       => 3,
                'is_active'   => true,
            ],
            [
                'category'    => 'school_adolescence',
                'type'        => 'games',
                'title'       => 'Juegos — Escolar y Adolescencia',
                'slug'        => Str::slug('Juegos Escolar y Adolescencia'),
                'description' => 'Juegos y actividades lúdicas para la población escolar y adolescente.',
                'order'       => 4,
                'is_active'   => true,
            ],
        ];

        foreach ($groups as $group) {
            EducationalMaterialGroup::updateOrCreate(
                ['category' => $group['category'], 'type' => $group['type']],
                $group
            );
        }

        $this->command->info('  ✓ 4 grupos de materiales educativos creados.');
    }
}
