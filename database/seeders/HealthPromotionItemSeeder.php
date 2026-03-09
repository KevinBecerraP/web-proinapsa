<?php

namespace Database\Seeders;

use App\Models\HealthPromotionCategory;
use App\Models\HealthPromotionItem;
use Illuminate\Database\Seeder;

class HealthPromotionItemSeeder extends Seeder
{
    public function run(): void
    {
        $earlyChildhood = HealthPromotionCategory::where('category', 'early_childhood')->first();
        $childhood      = HealthPromotionCategory::where('category', 'childhood')->first();
        $women          = HealthPromotionCategory::where('category', 'women')->first();
        $workers        = HealthPromotionCategory::where('category', 'workers')->first();

        $items = [
            // --- Primera Infancia ---
            [
                'category_id'       => $earlyChildhood?->id,
                'title'             => 'Lactancia Materna y Nutrición Infantil',
                'short_description' => 'Orientación a madres y cuidadores sobre los beneficios de la lactancia materna exclusiva hasta los 6 meses y la alimentación complementaria adecuada para el desarrollo del bebé.',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'category_id'       => $earlyChildhood?->id,
                'title'             => 'Estimulación Temprana del Desarrollo',
                'short_description' => 'Talleres prácticos para padres y cuidadores sobre actividades de estimulación del desarrollo cognitivo, motor, comunicativo y socioemocional en niños de 0 a 3 años.',
                'order'             => 2,
                'active'            => true,
            ],
            [
                'category_id'       => $earlyChildhood?->id,
                'title'             => 'Vínculo Afectivo y Crianza con Amor',
                'short_description' => 'Programa de formación para familias sobre la importancia del vínculo afectivo seguro, el apego y las prácticas de crianza positiva que favorecen el desarrollo integral de la primera infancia.',
                'order'             => 3,
                'active'            => true,
            ],
            [
                'category_id'       => $earlyChildhood?->id,
                'title'             => 'Detección Temprana de Alteraciones del Desarrollo',
                'short_description' => 'Capacitación a agentes educativos y profesionales de salud para identificar señales de alerta en el desarrollo infantil y activar rutas de atención oportunamente.',
                'order'             => 4,
                'active'            => true,
            ],

            // --- Niñez ---
            [
                'category_id'       => $childhood?->id,
                'title'             => 'Habilidades para la Vida en la Infancia',
                'short_description' => 'Programa dirigido a niños de 6 a 12 años para el desarrollo de habilidades socioemocionales: autoconocimiento, empatía, comunicación asertiva y resolución de conflictos.',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'category_id'       => $childhood?->id,
                'title'             => 'Nutrición y Hábitos Alimentarios Saludables',
                'short_description' => 'Talleres y actividades lúdicas para promover hábitos alimentarios saludables en niños en edad escolar, con participación de familias e instituciones educativas.',
                'order'             => 2,
                'active'            => true,
            ],
            [
                'category_id'       => $childhood?->id,
                'title'             => 'Prevención del Bullying y Convivencia Escolar',
                'short_description' => 'Estrategias de intervención para la prevención del acoso escolar, la promoción de la convivencia pacífica y el fortalecimiento de entornos escolares seguros y protectores.',
                'order'             => 3,
                'active'            => true,
            ],
            [
                'category_id'       => $childhood?->id,
                'title'             => 'Salud Bucal en la Infancia',
                'short_description' => 'Programa de educación en salud bucal para niños y sus familias, con énfasis en hábitos de higiene, alimentación protectora y visitas preventivas al odontólogo.',
                'order'             => 4,
                'active'            => true,
            ],

            // --- Mujer ---
            [
                'category_id'       => $women?->id,
                'title'             => 'Salud Mental y Bienestar Emocional de la Mujer',
                'short_description' => 'Espacios de orientación psicológica y grupos de apoyo para mujeres, con enfoque en la prevención y atención de la ansiedad, la depresión y el estrés relacionado con los roles de género.',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'category_id'       => $women?->id,
                'title'             => 'Salud Sexual y Reproductiva con Enfoque de Derechos',
                'short_description' => 'Información y orientación sobre salud sexual y reproductiva desde una perspectiva de derechos: métodos anticonceptivos, prevención de ITS, control prenatal y cuidado posparto.',
                'order'             => 2,
                'active'            => true,
            ],
            [
                'category_id'       => $women?->id,
                'title'             => 'Prevención de la Violencia contra la Mujer',
                'short_description' => 'Programa de formación y empoderamiento para la prevención de la violencia de género, con información sobre rutas de atención, derechos y estrategias de protección personal y comunitaria.',
                'order'             => 3,
                'active'            => true,
            ],
            [
                'category_id'       => $women?->id,
                'title'             => 'Mujer, Trabajo y Autocuidado',
                'short_description' => 'Talleres orientados a mujeres trabajadoras sobre la gestión del tiempo, el autocuidado, la prevención del estrés laboral y la conciliación entre la vida personal, familiar y profesional.',
                'order'             => 4,
                'active'            => true,
            ],

            // --- Trabajadores ---
            [
                'category_id'       => $workers?->id,
                'title'             => 'Gestión del Estrés y Prevención del Burnout',
                'short_description' => 'Programa para trabajadores de diferentes sectores sobre identificación y manejo del estrés laboral, prevención del síndrome de burnout y estrategias de autocuidado en el trabajo.',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'category_id'       => $workers?->id,
                'title'             => 'Ergonomía y Prevención de Lesiones Ocupacionales',
                'short_description' => 'Capacitación en ergonomía básica, posturas correctas, pausas activas y prevención de lesiones musculoesqueléticas en trabajadores de oficina, industria y sector servicios.',
                'order'             => 2,
                'active'            => true,
            ],
            [
                'category_id'       => $workers?->id,
                'title'             => 'Salud Mental en el Trabajo',
                'short_description' => 'Talleres para trabajadores y líderes de equipo sobre bienestar psicológico en el entorno laboral, comunicación asertiva, manejo de conflictos y construcción de ambientes de trabajo saludables.',
                'order'             => 3,
                'active'            => true,
            ],
            [
                'category_id'       => $workers?->id,
                'title'             => 'Estilos de Vida Saludable para Trabajadores',
                'short_description' => 'Programa integral de promoción de hábitos saludables para trabajadores: actividad física regular, alimentación equilibrada, descanso adecuado y prevención del sedentarismo en el entorno laboral.',
                'order'             => 4,
                'active'            => true,
            ],
        ];

        $created = 0;
        foreach ($items as $item) {
            if ($item['category_id'] !== null) {
                HealthPromotionItem::firstOrCreate(
                    ['category_id' => $item['category_id'], 'title' => $item['title']],
                    \Arr::except($item, ['category_id', 'title'])
                );
                $created++;
            }
        }

        $this->command->info('✅ ' . $created . ' ítems de promoción de salud creados exitosamente (4 por categoría).');
    }
}
