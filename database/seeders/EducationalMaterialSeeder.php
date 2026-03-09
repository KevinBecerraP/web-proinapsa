<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\EducationalMaterial;
use Illuminate\Database\Seeder;

class EducationalMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $area = Area::where('slug', 'educacion-comunicacion')->first();

        if (!$area) {
            $this->command->error('❌ No se encontró el área de Educación y Comunicación.');
            return;
        }

        $materials = [
            // --- Primera Infancia + Guías y Manuales ---
            [
                'area_id'           => $area->id,
                'category'          => 'early_childhood',
                'type'              => 'guides_manuals',
                'title'             => 'Guía de Estimulación Temprana',
                'short_description' => 'Manual práctico para padres y cuidadores sobre técnicas de estimulación del desarrollo cognitivo, motor y socioemocional en niños de 0 a 3 años.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Esta guía ofrece a padres, madres y cuidadores herramientas concretas para estimular el desarrollo integral de los niños en sus primeros tres años de vida, la etapa más crítica del desarrollo humano.</p><p>Incluye actividades clasificadas por mes de vida, orientaciones sobre el desarrollo esperado, señales de alerta y recomendaciones para cada área del desarrollo: cognitiva, motora, comunicativa y socioemocional.</p><p>Todo el contenido está basado en evidencia científica y adaptado al contexto colombiano.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'area_id'           => $area->id,
                'category'          => 'early_childhood',
                'type'              => 'guides_manuals',
                'title'             => 'Manual del Agente Educativo en Primera Infancia',
                'short_description' => 'Recurso formativo para agentes educativos del ICBF y hogares comunitarios sobre prácticas de cuidado, crianza y educación inicial con enfoque de derechos.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Este manual está diseñado para fortalecer las competencias de los <strong>agentes educativos</strong> que trabajan con la primera infancia en hogares comunitarios, centros de desarrollo infantil y jardines infantiles.</p><p>Aborda los fundamentos del desarrollo infantil, las prácticas de cuidado calificado, la importancia del juego como mediador del aprendizaje, la atención a la diversidad y el trabajo con familias.</p><p>Incluye guías de actividad, fichas de observación del desarrollo y orientaciones para el trabajo con familias en situación de vulnerabilidad.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 2,
                'active'            => true,
            ],

            // --- Primera Infancia + Juegos ---
            [
                'area_id'           => $area->id,
                'category'          => 'early_childhood',
                'type'              => 'games',
                'title'             => 'Juegos Sensoriales para Bebés de 0 a 18 Meses',
                'short_description' => 'Colección de juegos y actividades sensoriales diseñadas para estimular los sentidos y el desarrollo neurológico de bebés en sus primeros 18 meses de vida.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Los primeros 18 meses de vida son fundamentales para el desarrollo neurológico. Esta colección de <strong>juegos sensoriales</strong> ofrece actividades simples, económicas y efectivas para estimular los sentidos del bebé y fortalecer el vínculo con sus cuidadores.</p><p>Cada juego incluye descripción, materiales necesarios (preferiblemente del hogar), instrucciones y el objetivo de desarrollo que trabaja. Las actividades están organizadas por rango de edad: 0-3 meses, 4-6 meses, 7-12 meses y 13-18 meses.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => 'placeholder.jpg',
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'area_id'           => $area->id,
                'category'          => 'early_childhood',
                'type'              => 'games',
                'title'             => 'Juego Simbólico y Narrativo para Niños de 3 a 6 Años',
                'short_description' => 'Propuesta de actividades lúdicas centradas en el juego simbólico y la narración de cuentos para el desarrollo del lenguaje, la imaginación y las habilidades sociales en preescolar.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>El <strong>juego simbólico</strong> es el lenguaje natural de la infancia. A través del juego de roles, la dramatización y la narración de cuentos, los niños de 3 a 6 años desarrollan el lenguaje, la creatividad, la empatía y las habilidades sociales esenciales para su vida.</p><p>Esta colección incluye propuestas de juego simbólico estructurado y libre, guías para la narración de cuentos con propósito terapéutico y educativo, y herramientas para la observación del desarrollo durante el juego.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 2,
                'active'            => true,
            ],

            // --- Escolar/Adolescencia + Guías y Manuales ---
            [
                'area_id'           => $area->id,
                'category'          => 'school_adolescence',
                'type'              => 'guides_manuals',
                'title'             => 'Guía de Habilidades para la Vida en Adolescentes',
                'short_description' => 'Manual basado en el enfoque de la OMS sobre habilidades para la vida, con actividades y estrategias para docentes y orientadores escolares que trabajan con jóvenes de 12 a 18 años.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Las <strong>Habilidades para la Vida</strong> son competencias psicosociales que permiten a las personas enfrentar de manera efectiva los desafíos del diario vivir. Basada en el enfoque de la OMS, esta guía ofrece actividades y estrategias para desarrollar estas competencias en adolescentes.</p><p>Incluye actividades para trabajar las 10 habilidades para la vida definidas por la OMS: autoconocimiento, empatía, comunicación asertiva, relaciones interpersonales, toma de decisiones, resolución de problemas, pensamiento crítico, pensamiento creativo, manejo de emociones y manejo del estrés.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'area_id'           => $area->id,
                'category'          => 'school_adolescence',
                'type'              => 'guides_manuals',
                'title'             => 'Manual de Orientación Vocacional para Jóvenes',
                'short_description' => 'Guía práctica de orientación vocacional y profesional para estudiantes de grado 10 y 11, que facilita el proceso de autoconocimiento y toma de decisiones sobre el proyecto de vida.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Elegir un camino de vida es uno de los momentos más importantes y desafiantes de la adolescencia. Este manual ofrece a los estudiantes de grado 10 y 11 herramientas para <strong>explorar sus intereses, habilidades y valores</strong>, conocer las opciones de formación y construir un proyecto de vida coherente con sus aspiraciones.</p><p>Incluye cuestionarios de autoconocimiento, fichas de exploración vocacional, información sobre opciones de formación técnica, tecnológica y universitaria, y actividades grupales de reflexión sobre el proyecto de vida.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 2,
                'active'            => true,
            ],

            // --- Escolar/Adolescencia + Juegos ---
            [
                'area_id'           => $area->id,
                'category'          => 'school_adolescence',
                'type'              => 'games',
                'title'             => 'Juegos Cooperativos para la Convivencia Escolar',
                'short_description' => 'Colección de juegos cooperativos y dinámicas grupales diseñadas para fortalecer la convivencia, el trabajo en equipo y la resolución pacífica de conflictos en el aula.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>La <strong>convivencia escolar</strong> es un componente fundamental de la salud mental y el bienestar de los estudiantes. Esta colección de juegos cooperativos ofrece a docentes y orientadores escolares herramientas lúdicas para fortalecer el trabajo en equipo, la empatía y la resolución pacífica de conflictos en el aula.</p><p>Incluye más de 30 dinámicas y juegos cooperativos clasificados por edad (6-9 años, 10-13 años y 14-17 años), objetivos, materiales, instrucciones y sugerencias de reflexión posterior al juego.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => 'placeholder.jpg',
                'gallery_image_4'   => 'placeholder.jpg',
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'area_id'           => $area->id,
                'category'          => 'school_adolescence',
                'type'              => 'games',
                'title'             => 'Dinámicas de Educación Socioemocional para Secundaria',
                'short_description' => 'Propuesta de actividades y juegos para el desarrollo de competencias socioemocionales en estudiantes de secundaria: autogestión, empatía, toma de decisiones responsable.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>La <strong>educación socioemocional</strong> es reconocida mundialmente como un componente esencial de una educación integral y de calidad. Esta propuesta ofrece dinámicas, juegos y actividades para desarrollar las competencias socioemocionales de los estudiantes de secundaria.</p><p>Las actividades están organizadas en cinco bloques temáticos: autoconciencia, autorregulación, conciencia social, habilidades relacionales y toma de decisiones responsable. Cada actividad incluye objetivo, desarrollo, materiales y sugerencias de adaptación.</p>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'gallery_image_4'   => null,
                'gallery_image_5'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'order'             => 2,
                'active'            => true,
            ],
        ];

        foreach ($materials as $material) {
            EducationalMaterial::firstOrCreate(['title' => $material['title']], \Arr::except($material, ['title']));
        }

        $this->command->info('✅ ' . count($materials) . ' materiales educativos creados exitosamente.');
    }
}
