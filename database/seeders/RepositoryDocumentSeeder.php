<?php

namespace Database\Seeders;

use App\Models\RepositoryCategory;
use App\Models\RepositoryDocument;
use Illuminate\Database\Seeder;

class RepositoryDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $politicaId   = RepositoryCategory::where('title', 'Documentos de Política en Salud')->first()?->id;
        $guiasId      = RepositoryCategory::where('title', 'Guías y Protocolos Clínicos')->first()?->id;
        $investigaId  = RepositoryCategory::where('title', 'Investigaciones y Estudios')->first()?->id;
        $materialesId = RepositoryCategory::where('title', 'Materiales Educativos')->first()?->id;

        $documents = [
            // --- Documentos de Política en Salud ---
            [
                'repository_category_id' => $politicaId,
                'title'       => 'Política de Atención Integral en Salud (PAIS) - Guía de Implementación',
                'authors'     => 'Ministerio de Salud y Protección Social',
                'topic'       => 'Política de salud',
                'description' => 'Documento oficial con los lineamientos para la implementación de la Política de Atención Integral en Salud en los territorios, incluyendo ruta de atención y roles de los actores del sistema.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'repository_category_id' => $politicaId,
                'title'       => 'Plan Decenal de Salud Pública 2022-2031: Resumen Ejecutivo',
                'authors'     => 'Ministerio de Salud y Protección Social',
                'topic'       => 'Planificación en salud',
                'description' => 'Resumen ejecutivo del Plan Decenal de Salud Pública de Colombia, que establece los objetivos, metas e indicadores para mejorar las condiciones de salud de la población colombiana.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'repository_category_id' => $politicaId,
                'title'       => 'Resolución 3280 de 2018: Rutas Integrales de Atención en Salud',
                'authors'     => 'Ministerio de Salud y Protección Social',
                'topic'       => 'Normatividad',
                'description' => 'Texto completo de la resolución que adopta las Rutas Integrales de Atención en Salud (RIAS) y el Modelo Integral de Atención en Salud (MIAS) para Colombia.',
                'image'       => null,
                'document'    => 'placeholder.pdf',
                'order'       => 3,
                'status'      => true,
            ],
            [
                'repository_category_id' => $politicaId,
                'title'       => 'Política Nacional de Salud Mental de Colombia',
                'authors'     => 'Ministerio de Salud y Protección Social',
                'topic'       => 'Salud mental',
                'description' => 'Documento de política que establece los lineamientos para la promoción de la salud mental, la prevención de los trastornos mentales y la atención integral a la enfermedad mental en Colombia.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 4,
                'status'      => true,
            ],

            // --- Guías y Protocolos Clínicos ---
            [
                'repository_category_id' => $guiasId,
                'title'       => 'Guía de Detección Temprana de Alteraciones en el Desarrollo Infantil',
                'authors'     => 'Instituto Proinapsa - Área de Educación y Comunicación',
                'topic'       => 'Desarrollo infantil',
                'description' => 'Protocolo para la identificación temprana de señales de alerta en el desarrollo cognitivo, motor, socioemocional y comunicativo de niños de 0 a 5 años.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'repository_category_id' => $guiasId,
                'title'       => 'Protocolo de Primeros Auxilios Psicológicos en Situaciones de Crisis',
                'authors'     => 'Instituto Proinapsa - Área de Proyección Social',
                'topic'       => 'Atención en crisis',
                'description' => 'Manual de procedimientos para brindar primeros auxilios psicológicos en situaciones de emergencia, desastre o crisis individual. Incluye casos prácticos y herramientas de evaluación.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'repository_category_id' => $guiasId,
                'title'       => 'Guía de Intervención en Violencia Intrafamiliar para Equipos de Salud',
                'authors'     => 'Instituto Proinapsa - Área de Proyección Social',
                'topic'       => 'Violencia intrafamiliar',
                'description' => 'Herramienta práctica para que los equipos de salud puedan identificar, reportar y orientar casos de violencia intrafamiliar, con enfoque de derechos y género.',
                'image'       => null,
                'document'    => 'placeholder.pdf',
                'order'       => 3,
                'status'      => true,
            ],

            // --- Investigaciones y Estudios ---
            [
                'repository_category_id' => $investigaId,
                'title'       => 'Factores protectores del bienestar psicológico en primera infancia en zonas rurales de Antioquia',
                'authors'     => 'González, M.E.; Martínez, C.A.; Pérez, J.D.',
                'topic'       => 'Primera infancia',
                'description' => 'Estudio mixto de dos años que identifica los principales factores protectores del bienestar psicológico en niños de 0 a 6 años de zonas rurales, con una muestra de 847 familias en 12 municipios de Antioquia.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'repository_category_id' => $investigaId,
                'title'       => 'Prevalencia de burnout en trabajadores de la salud de Medellín 2023',
                'authors'     => 'Martínez, C.A.; Cárdenas, R.A.; López, D.M.',
                'topic'       => 'Salud ocupacional',
                'description' => 'Investigación cuantitativa sobre la prevalencia del síndrome de burnout en 520 trabajadores del sector salud de la ciudad de Medellín, con análisis por tipo de institución y cargo.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'repository_category_id' => $investigaId,
                'title'       => 'Intervención psicosocial en comunidades afectadas por el conflicto armado en Antioquia',
                'authors'     => 'Sánchez, L.P.; López, D.M.; González, M.E.',
                'topic'       => 'Intervención comunitaria',
                'description' => 'Sistematización de experiencias de intervención psicosocial desarrolladas por el Instituto Proinapsa en 8 municipios de Antioquia con alta incidencia del conflicto armado entre 2019 y 2022.',
                'image'       => null,
                'document'    => 'placeholder.pdf',
                'order'       => 3,
                'status'      => true,
            ],

            // --- Materiales Educativos ---
            [
                'repository_category_id' => $materialesId,
                'title'       => 'Guía de Actividades Lúdicas para el Desarrollo Infantil Integral (3-8 años)',
                'authors'     => 'Área de Educación y Comunicación - Instituto Proinapsa',
                'topic'       => 'Desarrollo infantil',
                'description' => 'Material educativo con más de 60 actividades lúdicas clasificadas por edad y área de desarrollo. Dirigida a padres, cuidadores y docentes de primera infancia y básica primaria.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'repository_category_id' => $materialesId,
                'title'       => 'Cartilla de Hábitos Saludables para Adolescentes',
                'authors'     => 'Área de Educación y Comunicación - Instituto Proinapsa',
                'topic'       => 'Hábitos saludables',
                'description' => 'Material educativo dirigido a jóvenes de 12 a 17 años sobre la importancia de los hábitos saludables en la alimentación, el sueño, la actividad física y el uso responsable de las tecnologías.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'repository_category_id' => $materialesId,
                'title'       => 'Manual de Autocuidado para Profesionales de la Salud',
                'authors'     => 'Área de Proyección Social - Instituto Proinapsa',
                'topic'       => 'Autocuidado',
                'description' => 'Guía práctica con estrategias de autocuidado físico, emocional y social para profesionales del sector salud, con especial énfasis en la prevención del burnout y el manejo del estrés laboral.',
                'image'       => 'placeholder.jpg',
                'document'    => 'placeholder.pdf',
                'order'       => 3,
                'status'      => true,
            ],
        ];

        foreach ($documents as $document) {
            RepositoryDocument::firstOrCreate(['title' => $document['title']], \Arr::except($document, ['title']));
        }

        $this->command->info('✅ ' . count($documents) . ' documentos del repositorio creados exitosamente.');
    }
}
