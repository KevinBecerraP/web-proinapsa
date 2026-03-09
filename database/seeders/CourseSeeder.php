<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $educacionId   = Area::where('slug', 'educacion-comunicacion')->first()?->id;
        $investigaId   = Area::where('slug', 'investigacion')->first()?->id;
        $proyeccionId  = Area::where('slug', 'proyeccion-social')->first()?->id;

        $courses = [
            // --- Área: Educación y Comunicación ---
            [
                'area_id'           => $educacionId,
                'title'             => 'Primeros Auxilios Psicológicos',
                'short_description' => 'Aprende a brindar apoyo psicológico básico en situaciones de emergencia, crisis o desastre. Curso práctico con enfoque en intervención inmediata y estabilización emocional.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Los <strong>Primeros Auxilios Psicológicos (PAP)</strong> son una intervención de apoyo psicológico básico que se brinda a personas afectadas por situaciones de emergencia, crisis, desastres o eventos traumáticos.</p><p>Este curso te enseñará a <strong>identificar, acercarte y estabilizar</strong> emocionalmente a personas en situación de crisis, utilizando técnicas validadas y recomendadas por la Organización Mundial de la Salud y la Federación Internacional de la Cruz Roja.</p><p><strong>Contenidos del curso:</strong></p><ul><li>Fundamentos de los Primeros Auxilios Psicológicos</li><li>El modelo de los 5 principios básicos de los PAP</li><li>Cómo acercarse a alguien en crisis</li><li>Técnicas de estabilización emocional</li><li>Autocuidado del auxiliador</li><li>Casos prácticos y simulaciones</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'pdf_file'          => null,
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/primeros-auxilios-psicologicos',
                'duration_hours'    => 40,
                'order'             => 1,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Salud Mental en el Entorno Laboral',
                'short_description' => 'Herramientas para promover el bienestar psicológico en el trabajo, prevenir el burnout y gestionar el estrés laboral. Dirigido a profesionales y líderes de equipos.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>El <strong>entorno laboral</strong> es uno de los principales determinantes de la salud mental de las personas. Este curso ofrece herramientas conceptuales y prácticas para promover ambientes de trabajo saludables y prevenir el deterioro del bienestar psicológico.</p><p>Al finalizar el curso, los participantes estarán en capacidad de <strong>identificar factores de riesgo psicosocial en el trabajo</strong>, implementar estrategias de autocuidado y bienestar, y promover una cultura organizacional que favorezca la salud mental.</p><p><strong>Contenidos:</strong></p><ul><li>Salud mental y trabajo: marco conceptual</li><li>Factores psicosociales laborales</li><li>El síndrome de burnout: diagnóstico y prevención</li><li>Gestión del estrés y técnicas de afrontamiento</li><li>Comunicación asertiva en el trabajo</li><li>Diseño de programas de bienestar laboral</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/salud-mental-laboral',
                'duration_hours'    => 60,
                'order'             => 2,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Comunicación Asertiva y Resolución de Conflictos',
                'short_description' => 'Desarrolla habilidades de comunicación efectiva y aprende técnicas para resolver conflictos de manera constructiva en contextos personales, comunitarios y organizacionales.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>La <strong>comunicación asertiva</strong> es una habilidad fundamental para el bienestar personal y las relaciones interpersonales. En este curso aprenderás a expresarte de forma clara, respetuosa y efectiva, y a manejar los conflictos como oportunidades de crecimiento.</p><p>El curso combina teoría, práctica y role-playing para desarrollar competencias comunicativas aplicables en diferentes contextos: familiar, laboral, comunitario y social.</p><p><strong>Contenidos:</strong></p><ul><li>Estilos de comunicación: pasivo, agresivo y asertivo</li><li>Comunicación no verbal y paraverbal</li><li>Escucha activa y empatía</li><li>El conflicto como oportunidad</li><li>Técnicas de negociación y mediación</li><li>Comunicación en contextos de diversidad</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'pdf_file'          => null,
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/comunicacion-asertiva',
                'duration_hours'    => 32,
                'order'             => 3,
            ],
            [
                'area_id'           => $educacionId,
                'title'             => 'Educación para la Salud Sexual y Reproductiva',
                'short_description' => 'Formación integral en salud sexual y reproductiva desde un enfoque de derechos, género e interseccionalidad. Dirigido a docentes, orientadores y profesionales de la salud.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Este curso ofrece una formación integral en <strong>salud sexual y reproductiva</strong> con un enfoque basado en derechos, género e interseccionalidad. Está diseñado para profesionales que trabajan con jóvenes y adolescentes en contextos educativos, de salud o comunitarios.</p><p><strong>Contenidos:</strong></p><ul><li>Marco de derechos sexuales y reproductivos</li><li>Anatomía y fisiología sexual y reproductiva</li><li>Métodos anticonceptivos: evidencia y orientación</li><li>Prevención de ITS y VIH/SIDA</li><li>Educación sexual integral en la escuela</li><li>Violencia sexual: prevención, detección y ruta de atención</li><li>Diversidad sexual e identidad de género</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'status'            => 'finished',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/educacion-sexual',
                'duration_hours'    => 80,
                'order'             => 4,
            ],

            // --- Área: Investigación ---
            [
                'area_id'           => $investigaId,
                'title'             => 'Metodología de Investigación en Salud',
                'short_description' => 'Curso teórico-práctico para el diseño y ejecución de investigaciones en salud pública. Aborda enfoques cuantitativos, cualitativos y mixtos con aplicaciones reales.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Este curso proporciona los fundamentos metodológicos para el diseño y ejecución de investigaciones en el campo de la salud pública y las ciencias de la salud.</p><p>Los participantes aprenderán a <strong>formular preguntas de investigación</strong>, seleccionar el diseño metodológico más apropiado, construir instrumentos de recolección de datos, analizar resultados y presentar hallazgos con rigor científico.</p><p><strong>Contenidos:</strong></p><ul><li>Fundamentos del pensamiento científico en salud</li><li>Investigación cuantitativa: diseños descriptivos y analíticos</li><li>Investigación cualitativa: etnografía, fenomenología y teoría fundamentada</li><li>Métodos mixtos en investigación en salud</li><li>Ética en la investigación con seres humanos</li><li>Escritura científica y publicación académica</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/metodologia-investigacion',
                'duration_hours'    => 120,
                'order'             => 1,
            ],
            [
                'area_id'           => $investigaId,
                'title'             => 'Análisis de Datos con SPSS para Investigadores en Salud',
                'short_description' => 'Aprende a procesar, analizar e interpretar datos cuantitativos usando SPSS. Curso práctico con ejercicios basados en investigaciones reales de salud pública.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>El dominio del <strong>análisis estadístico</strong> es una competencia esencial para los investigadores en salud. Este curso proporciona los conocimientos y habilidades para usar SPSS en el análisis de datos de investigaciones en salud pública.</p><p><strong>Contenidos:</strong></p><ul><li>Introducción a SPSS: interfaz y funciones básicas</li><li>Estadística descriptiva: medidas de tendencia central y dispersión</li><li>Tablas de frecuencia y gráficos estadísticos</li><li>Pruebas de normalidad y supuestos estadísticos</li><li>Pruebas de hipótesis: T-test, ANOVA, Chi-cuadrado</li><li>Correlación y regresión lineal</li><li>Interpretación y reporte de resultados</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'pdf_file'          => null,
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/spss-investigadores',
                'duration_hours'    => 48,
                'order'             => 2,
            ],

            // --- Área: Proyección Social ---
            [
                'area_id'           => $proyeccionId,
                'title'             => 'Estrategias de Intervención Comunitaria en Salud',
                'short_description' => 'Formación en metodologías participativas para la intervención comunitaria en salud. Diseño, implementación y evaluación de proyectos con enfoque territorial y de derechos.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>La <strong>intervención comunitaria en salud</strong> requiere de metodologías participativas, contextualización territorial y un profundo respeto por el saber comunitario. Este curso forma a los participantes en el diseño e implementación de estrategias efectivas de intervención en salud con comunidades.</p><p><strong>Contenidos:</strong></p><ul><li>Fundamentos de la participación comunitaria en salud</li><li>Diagnóstico participativo y mapeo de actores</li><li>Diseño de proyectos de salud comunitaria</li><li>Comunicación para el cambio de comportamiento</li><li>Trabajo con grupos poblacionales específicos: mujeres, niñez, adultos mayores</li><li>Evaluación y sistematización de experiencias comunitarias</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => 'placeholder.jpg',
                'gallery_image_3'   => 'placeholder.jpg',
                'pdf_file'          => 'placeholder.pdf',
                'status'            => 'active',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/intervencion-comunitaria',
                'duration_hours'    => 80,
                'order'             => 1,
            ],
            [
                'area_id'           => $proyeccionId,
                'title'             => 'Atención Psicosocial a Víctimas del Conflicto Armado',
                'short_description' => 'Curso especializado en atención psicosocial a personas y comunidades afectadas por el conflicto armado en Colombia, con enfoque de derechos y enfoques diferenciales.',
                'main_image'        => 'placeholder.jpg',
                'full_description'  => '<p>Colombia tiene una deuda histórica con las víctimas del conflicto armado. Este curso forma a profesionales en la <strong>atención psicosocial con enfoque diferencial y de derechos</strong>, para acompañar procesos de recuperación emocional, reparación y reconciliación en comunidades afectadas.</p><p><strong>Contenidos:</strong></p><ul><li>Marco legal y normativo para la atención a víctimas en Colombia</li><li>Impactos psicosociales del conflicto armado</li><li>El duelo y la pérdida en contextos de violencia</li><li>Atención psicosocial individual y grupal</li><li>Enfoque diferencial: género, etnia, ciclo vital</li><li>El modelo de atención psicosocial en salud (PAPSIVI)</li><li>Autocuidado del profesional en contextos de violencia</li></ul>',
                'gallery_image_1'   => 'placeholder.jpg',
                'gallery_image_2'   => null,
                'gallery_image_3'   => null,
                'pdf_file'          => 'placeholder.pdf',
                'status'            => 'inactive',
                'registration_link' => 'https://www.proinapsa.edu.co/inscripciones/atencion-victimas',
                'duration_hours'    => 100,
                'order'             => 2,
            ],
        ];

        foreach ($courses as $course) {
            Course::firstOrCreate(['title' => $course['title']], \Arr::except($course, ['title']));
        }

        $this->command->info('✅ ' . count($courses) . ' cursos creados exitosamente.');
    }
}
