<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\ResearchGroup;
use Illuminate\Database\Seeder;

class ResearchGroupSeeder extends Seeder
{
    public function run(): void
    {
        if (ResearchGroup::count() > 0) {
            $this->command->warn('⚠️  Ya existe un grupo de investigación. Se omite ResearchGroupSeeder.');
            return;
        }

        $area = Area::where('slug', 'investigacion')->first();

        if (!$area) {
            $this->command->error('❌ No se encontró el área de Investigación.');
            return;
        }

        ResearchGroup::create([
            'area_id'         => $area->id,
            'name'            => 'Grupo de Investigación en Salud, Bienestar y Comunidad - GISBC',
            'mini_description'=> 'Grupo de investigación del Instituto Proinapsa orientado a la generación de conocimiento científico en salud pública, bienestar psicosocial y desarrollo comunitario con impacto en poblaciones vulnerables.',
            'description'     => '<p>El <strong>Grupo de Investigación en Salud, Bienestar y Comunidad (GISBC)</strong> es el centro de producción científica del Instituto Proinapsa. Fundado en 2010, el grupo reúne a investigadores de diferentes disciplinas —psicología, salud pública, trabajo social, educación y medicina preventiva— en torno a preguntas comunes sobre la salud y el bienestar de las comunidades colombianas.</p><p>Nuestro enfoque investigativo es interdisciplinar, participativo y orientado al impacto social. Trabajamos con metodologías tanto cuantitativas como cualitativas, y privilegiamos la investigación en contextos reales, con y para las comunidades.</p><p>El GISBC está clasificado en la categoría B de Minciencias y cuenta con publicaciones en revistas indexadas nacionales e internacionales. Anualmente convocamos estudiantes de pregrado y posgrado para participar en nuestros semilleros y proyectos de investigación.</p>',
            'link'            => 'https://scienti.minciencias.gov.co/grupos',
            'active'          => true,
        ]);

        $this->command->info('✅ Grupo de investigación GISBC creado exitosamente.');
    }
}
