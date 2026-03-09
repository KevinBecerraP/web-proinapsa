<?php

namespace Database\Seeders;

use App\Models\Institutional;
use Illuminate\Database\Seeder;

class InstitutionalResourceSeeder extends Seeder
{
    public function run(): void
    {
        $resources = [
            // --- Links de Interés ---
            [
                'type'   => 'interest_link',
                'title'  => 'Ministerio de Salud y Protección Social',
                'url'    => 'https://www.minsalud.gov.co',
                'name'   => null,
                'image'  => null,
                'order'  => 1,
                'active' => true,
            ],
            [
                'type'   => 'interest_link',
                'title'  => 'Instituto Nacional de Salud (INS)',
                'url'    => 'https://www.ins.gov.co',
                'name'   => null,
                'image'  => null,
                'order'  => 2,
                'active' => true,
            ],
            [
                'type'   => 'interest_link',
                'title'  => 'Organización Panamericana de la Salud (OPS/OMS)',
                'url'    => 'https://www.paho.org/es',
                'name'   => null,
                'image'  => null,
                'order'  => 3,
                'active' => true,
            ],
            [
                'type'   => 'interest_link',
                'title'  => 'ICBF - Instituto Colombiano de Bienestar Familiar',
                'url'    => 'https://www.icbf.gov.co',
                'name'   => null,
                'image'  => null,
                'order'  => 4,
                'active' => true,
            ],
            [
                'type'   => 'interest_link',
                'title'  => 'Minciencias - Ministerio de Ciencia y Tecnología',
                'url'    => 'https://minciencias.gov.co',
                'name'   => null,
                'image'  => null,
                'order'  => 5,
                'active' => true,
            ],
            [
                'type'   => 'interest_link',
                'title'  => 'Secretaría de Salud de Antioquia',
                'url'    => 'https://www.dssa.gov.co',
                'name'   => null,
                'image'  => null,
                'order'  => 6,
                'active' => true,
            ],

            // --- Aliados / Socios ---
            [
                'type'   => 'partner',
                'title'  => null,
                'url'    => null,
                'name'   => 'Universidad de Antioquia',
                'image'  => 'placeholder.jpg',
                'order'  => 1,
                'active' => true,
            ],
            [
                'type'   => 'partner',
                'title'  => null,
                'url'    => null,
                'name'   => 'Gobernación de Antioquia',
                'image'  => 'placeholder.jpg',
                'order'  => 2,
                'active' => true,
            ],
            [
                'type'   => 'partner',
                'title'  => null,
                'url'    => null,
                'name'   => 'Alcaldía de Medellín',
                'image'  => 'placeholder.jpg',
                'order'  => 3,
                'active' => true,
            ],
            [
                'type'   => 'partner',
                'title'  => null,
                'url'    => null,
                'name'   => 'Corporación Universitaria Minuto de Dios',
                'image'  => 'placeholder.jpg',
                'order'  => 4,
                'active' => true,
            ],
            [
                'type'   => 'partner',
                'title'  => null,
                'url'    => null,
                'name'   => 'Fundación Saldarriaga Concha',
                'image'  => 'placeholder.jpg',
                'order'  => 5,
                'active' => true,
            ],
        ];

        foreach ($resources as $resource) {
            $key = $resource['type'] === 'partner'
                ? ['type' => $resource['type'], 'name' => $resource['name']]
                : ['type' => $resource['type'], 'title' => $resource['title']];
            Institutional::firstOrCreate($key, \Arr::except($resource, array_keys($key)));
        }

        $links    = collect($resources)->where('type', 'interest_link')->count();
        $partners = collect($resources)->where('type', 'partner')->count();

        $this->command->info("✅ {$links} links de interés y {$partners} aliados institucionales creados exitosamente.");
    }
}
