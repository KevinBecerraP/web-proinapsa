<?php

namespace Database\Seeders;

use App\Models\ResearchGroup;
use App\Models\ResearchLine;
use Illuminate\Database\Seeder;

class ResearchLineSeeder extends Seeder
{
    public function run(): void
    {
        $group = ResearchGroup::first();

        if (!$group) {
            $this->command->error('❌ No se encontró el grupo de investigación. Ejecuta primero ResearchGroupSeeder.');
            return;
        }

        $lines = [
            [
                'research_group_id' => $group->id,
                'title'             => 'Salud Mental y Bienestar Psicosocial',
                'description'       => 'Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia, trauma psicológico, y bienestar emocional en contextos comunitarios, laborales y educativos.',
                'order'             => 1,
                'active'            => true,
            ],
            [
                'research_group_id' => $group->id,
                'title'             => 'Educación para la Salud y Comunicación en Salud',
                'description'       => 'Investiga los procesos de educación para la salud, la comunicación en salud y los determinantes del comportamiento saludable. Desarrolla y evalúa intervenciones educativas, materiales didácticos y estrategias de comunicación orientadas a promover cambios de comportamiento en salud en distintos grupos poblacionales y contextos.',
                'order'             => 2,
                'active'            => true,
            ],
            [
                'research_group_id' => $group->id,
                'title'             => 'Salud en la Primera Infancia y Desarrollo Infantil',
                'description'       => 'Esta línea estudia los factores que determinan el desarrollo integral en los primeros años de vida, con énfasis en el desarrollo socioemocional, la crianza, el vínculo afectivo y los entornos de cuidado. Desarrolla propuestas de evaluación e intervención para la primera infancia en contextos familiares, comunitarios e institucionales.',
                'order'             => 3,
                'active'            => true,
            ],
            [
                'research_group_id' => $group->id,
                'title'             => 'Salud Laboral y Bienestar Ocupacional',
                'description'       => 'Investiga los riesgos psicosociales en el trabajo, la salud ocupacional y las estrategias para la promoción del bienestar en entornos laborales. Incluye investigación sobre estrés laboral, clima organizacional, motivación, satisfacción laboral y programas de bienestar en el trabajo, con especial atención al sector salud y educativo.',
                'order'             => 4,
                'active'            => true,
            ],
            [
                'research_group_id' => $group->id,
                'title'             => 'Intervención Comunitaria y Salud Pública',
                'description'       => 'Esta línea aborda la investigación sobre intervenciones comunitarias en salud, con énfasis en comunidades rurales, poblaciones vulnerables y grupos afectados por el conflicto armado. Utiliza metodologías participativas, investigación acción participativa (IAP) y enfoques de salud pública con perspectiva de derechos e interseccionalidad.',
                'order'             => 5,
                'active'            => true,
            ],
        ];

        foreach ($lines as $line) {
            ResearchLine::firstOrCreate(
                ['title' => $line['title'], 'research_group_id' => $line['research_group_id']],
                \Arr::except($line, ['title', 'research_group_id'])
            );
        }

        $this->command->info('✅ ' . count($lines) . ' líneas de investigación creadas exitosamente.');
    }
}
