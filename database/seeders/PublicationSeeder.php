<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $educacionId  = Area::where('slug', 'educacion-comunicacion')->first()?->id;
        $investigaId  = Area::where('slug', 'investigacion')->first()?->id;
        $proyeccionId = Area::where('slug', 'proyeccion-social')->first()?->id;

        $publications = [
            [
                'area_id'           => $investigaId,
                'title'             => 'Salud mental en adolescentes colombianos',
                'subtitle'          => 'Impacto del uso de redes sociales y estrategias de intervención',
                'short_description' => 'Estudio transversal sobre la asociación entre el uso intensivo de redes sociales y la prevalencia de síntomas de ansiedad y depresión en adolescentes colombianos de 13 a 17 años en zonas urbanas.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2023.001',
                'status'            => 'active',
                'order'             => 1,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Factores protectores en el desarrollo de la primera infancia',
                'subtitle'          => 'Una revisión sistemática desde el contexto latinoamericano',
                'short_description' => 'Revisión sistemática de la literatura científica sobre los principales factores protectores del desarrollo integral en la primera infancia, con énfasis en el contexto latinoamericano y colombiano.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2023.002',
                'status'            => 'active',
                'order'             => 2,
            ],
            [
                'area_id'           => $investigaId,
                'title'             => 'Bienestar psicológico en trabajadores de la salud',
                'subtitle'          => 'Burnout y factores protectores en el sector hospitalario antioqueño',
                'short_description' => 'Investigación cuantitativa sobre la prevalencia del burnout y los factores protectores del bienestar psicológico en 520 trabajadores del sector salud de Antioquia durante el período pospandemia.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2023.003',
                'status'            => 'active',
                'order'             => 3,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Educación para la salud con enfoque intercultural',
                'subtitle'          => 'Experiencias en comunidades rurales indígenas del Urabá antioqueño',
                'short_description' => 'Sistematización de experiencias de educación para la salud con enfoque intercultural desarrolladas en comunidades indígenas del Urabá antioqueño, analizando las adaptaciones metodológicas y los resultados obtenidos.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2022.004',
                'status'            => 'active',
                'order'             => 4,
            ],
            [
                'area_id'           => $proyeccionId,
                'title'             => 'Intervención psicosocial en comunidades afectadas por el conflicto',
                'subtitle'          => 'Una revisión sistemática de intervenciones en Colombia 2016-2022',
                'short_description' => 'Revisión sistemática de las intervenciones psicosociales desarrolladas en comunidades colombianas afectadas por el conflicto armado en el período posacuerdo de paz (2016-2022), evaluando su efectividad y lecciones aprendidas.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2022.005',
                'status'            => 'active',
                'order'             => 5,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Promoción de hábitos alimentarios saludables en edad escolar',
                'subtitle'          => 'Efectividad de un programa de intervención en colegios de Medellín',
                'short_description' => 'Estudio cuasiexperimental que evalúa la efectividad de un programa de promoción de hábitos alimentarios saludables implementado en 8 instituciones educativas de Medellín, con seguimiento de 12 meses.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2022.006',
                'status'            => 'active',
                'order'             => 6,
            ],
            [
                'area_id'           => $proyeccionId,
                'title'             => 'Resiliencia comunitaria en mujeres rurales de Antioquia',
                'subtitle'          => 'Estrategias de afrontamiento y redes de apoyo social',
                'short_description' => 'Investigación cualitativa sobre las estrategias de resiliencia y afrontamiento del estrés en grupos de mujeres rurales de Antioquia, con especial atención al papel de las redes de apoyo social y comunitario.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2021.007',
                'status'            => 'active',
                'order'             => 7,
            ],
            [
                'area_id'           => $investigaId,
                'title'             => 'Indicadores de bienestar en primera infancia',
                'subtitle'          => 'Propuesta de medición comunitaria y participativa',
                'short_description' => 'Artículo metodológico que propone un sistema de indicadores de bienestar en primera infancia diseñado de manera participativa con comunidades rurales, basado en sus propias concepciones del desarrollo y el buen vivir.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2021.008',
                'status'            => 'active',
                'order'             => 8,
            ],
            [
                'area_id'           => $investigaId,
                'title'             => 'Gestión del estrés en entornos laborales modernos',
                'subtitle'          => 'Una revisión de intervenciones basadas en mindfulness',
                'short_description' => 'Revisión narrativa de la literatura sobre la efectividad de las intervenciones basadas en mindfulness para la gestión del estrés en trabajadores de diferentes sectores, con recomendaciones para su implementación en Colombia.',
                'image'             => 'placeholder.jpg',
                'external_link'     => 'https://doi.org/10.1000/proinapsa.2021.009',
                'status'            => 'inactive',
                'order'             => 9,
            ],
        ];

        foreach ($publications as $publication) {
            Publication::firstOrCreate(['title' => $publication['title']], \Arr::except($publication, ['title']));
        }

        $this->command->info('✅ ' . count($publications) . ' publicaciones creadas exitosamente.');
    }
}
