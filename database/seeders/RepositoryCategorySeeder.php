<?php

namespace Database\Seeders;

use App\Models\RepositoryCategory;
use Illuminate\Database\Seeder;

class RepositoryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title'       => 'Documentos de Política en Salud',
                'description' => 'Compilación de documentos normativos, políticas públicas, resoluciones y lineamientos del sector salud a nivel nacional, departamental y municipal.',
                'image'       => 'placeholder.jpg',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'title'       => 'Guías y Protocolos Clínicos',
                'description' => 'Guías de práctica clínica, protocolos de atención, manuales de procedimientos y herramientas de diagnóstico para profesionales de la salud.',
                'image'       => 'placeholder.jpg',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'title'       => 'Investigaciones y Estudios',
                'description' => 'Artículos científicos, informes de investigación, tesis y estudios realizados por el equipo del Instituto Proinapsa y aliados académicos.',
                'image'       => 'placeholder.jpg',
                'order'       => 3,
                'status'      => true,
            ],
            [
                'title'       => 'Materiales Educativos',
                'description' => 'Guías didácticas, cartillas, infografías, videos educativos y materiales de apoyo para procesos de formación en salud y bienestar.',
                'image'       => 'placeholder.jpg',
                'order'       => 4,
                'status'      => true,
            ],
        ];

        foreach ($categories as $category) {
            RepositoryCategory::firstOrCreate(['title' => $category['title']], \Arr::except($category, ['title']));
        }

        $this->command->info('✅ ' . count($categories) . ' categorías de repositorio creadas exitosamente.');
    }
}
