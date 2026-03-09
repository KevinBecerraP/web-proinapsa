<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\FormalEducationSection;
use Illuminate\Database\Seeder;

class FormalEducationSectionSeeder extends Seeder
{
    public function run(): void
    {
        $area = Area::where('slug', 'educacion-comunicacion')->first();

        if (!$area) {
            $this->command->error('❌ No se encontró el área de Educación y Comunicación.');
            return;
        }

        $sections = [
            // --- GENERALIDADES ---
            [
                'area_id'     => $area->id,
                'section'     => 'generalities',
                'title'       => 'Descripción del Programa',
                'description' => 'El área de Educación y Comunicación del Instituto Proinapsa ofrece programas de formación formal y no formal dirigidos a profesionales, técnicos y comunidades en general. Nuestros programas están diseñados para fortalecer las competencias en salud pública, educación para la salud y comunicación comunitaria, con metodologías activas, participativas y basadas en evidencia.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'generalities',
                'title'       => 'Población Objetivo',
                'description' => 'Nuestros programas están dirigidos a profesionales de la salud, trabajo social, psicología, educación y áreas afines; técnicos y auxiliares del sector salud; docentes y orientadores escolares; líderes comunitarios y comunitarios de base; y cualquier persona interesada en fortalecer sus conocimientos en salud y bienestar.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 2,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'generalities',
                'title'       => 'Certificación y Avales',
                'description' => 'Todos nuestros programas cuentan con certificado de participación emitido por el Instituto Proinapsa. Algunos programas cuentan adicionalmente con el aval de instituciones de educación superior aliadas. Los certificados son reconocidos por entidades gubernamentales y del sector privado a nivel regional y nacional.',
                'image'       => null,
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 3,
                'active'      => true,
            ],

            // --- MODALIDADES ---
            [
                'area_id'     => $area->id,
                'section'     => 'modalities',
                'title'       => 'Modalidad Presencial',
                'description' => 'Clases en las instalaciones del Instituto Proinapsa en Medellín. Incluye acceso a materiales físicos, laboratorios de simulación y espacios de práctica. Ideal para quienes prefieren la interacción directa con docentes y compañeros. Horarios disponibles en jornada diurna y nocturna.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'modalities',
                'title'       => 'Modalidad Virtual',
                'description' => 'Acceso a todos los contenidos a través de nuestra plataforma educativa en línea. Incluye clases en vivo por videoconferencia, foros, materiales descargables y evaluaciones digitales. Permite estudiar desde cualquier lugar con conexión a internet. Soporte técnico disponible durante el proceso.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 2,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'modalities',
                'title'       => 'Modalidad Híbrida',
                'description' => 'Combina sesiones presenciales con actividades virtuales. Las sesiones presenciales se realizan quincenalmente en las instalaciones del instituto, mientras que el trabajo virtual incluye lecturas, foros, talleres en línea y encuentros sincrónicos. Diseñada para ofrecer flexibilidad sin perder la riqueza de la experiencia presencial.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 3,
                'active'      => true,
            ],

            // --- PROCEDIMIENTOS ---
            [
                'area_id'     => $area->id,
                'section'     => 'procedures',
                'title'       => 'Proceso de Inscripción',
                'description' => 'Para inscribirse en cualquiera de nuestros programas, el interesado debe: (1) Completar el formulario de inscripción disponible en nuestro sitio web o en las instalaciones del instituto. (2) Presentar documentos requeridos (fotocopia del documento de identidad, título o diploma del nivel educativo exigido para el programa). (3) Realizar el pago o gestionar el acuerdo de pago. (4) Recibir confirmación de matrícula al correo electrónico registrado.',
                'image'       => null,
                'pdf_file'    => 'placeholder.pdf',
                'url'         => null,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'procedures',
                'title'       => 'Formas de Pago',
                'description' => 'El Instituto Proinapsa acepta las siguientes formas de pago: efectivo en caja del instituto, transferencia bancaria (datos disponibles en secretaría), tarjeta de crédito/débito en las instalaciones, y acuerdo de pago en cuotas (previa evaluación). También contamos con convenios con empresas para capacitación de empleados. Consulte opciones de descuento para grupos.',
                'image'       => null,
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 2,
                'active'      => true,
            ],

            // --- COMPROMISOS DEL INSTITUTO ---
            [
                'area_id'     => $area->id,
                'section'     => 'institute_commitments',
                'title'       => 'Calidad Académica',
                'description' => 'El Instituto Proinapsa se compromete a ofrecer programas de formación de alta calidad, con docentes altamente calificados, metodologías actualizadas y materiales educativos pertinentes. Realizamos evaluaciones periódicas de nuestros programas y aplicamos procesos de mejora continua basados en la retroalimentación de los participantes.',
                'image'       => 'placeholder.jpg',
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'institute_commitments',
                'title'       => 'Acompañamiento al Participante',
                'description' => 'Garantizamos un acompañamiento integral a cada participante durante todo el proceso formativo: orientación académica, soporte técnico para plataformas virtuales, atención de dificultades de aprendizaje y seguimiento al desempeño. Nuestro equipo está disponible para resolver dudas y brindar apoyo personalizado.',
                'image'       => null,
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 2,
                'active'      => true,
            ],

            // --- COMPROMISOS DEL PARTICIPANTE ---
            [
                'area_id'     => $area->id,
                'section'     => 'intern_commitments',
                'title'       => 'Asistencia y Puntualidad',
                'description' => 'El participante se compromete a asistir al mínimo del 80% de las sesiones programadas (presenciales y/o sincrónicas). En caso de ausencia justificada, deberá informar oportunamente al instituto y cumplir con las actividades de nivelación asignadas por el docente. El incumplimiento de este compromiso puede generar la no certificación del proceso.',
                'image'       => null,
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'area_id'     => $area->id,
                'section'     => 'intern_commitments',
                'title'       => 'Cumplimiento de Actividades',
                'description' => 'El participante debe entregar oportunamente todas las actividades, talleres y evaluaciones establecidas en el programa. Igualmente, se compromete a respetar las normas de convivencia del instituto, mantener un trato respetuoso con docentes y compañeros, y hacer un uso ético y responsable de los materiales y recursos educativos.',
                'image'       => null,
                'pdf_file'    => null,
                'url'         => null,
                'order'       => 2,
                'active'      => true,
            ],
        ];

        foreach ($sections as $section) {
            FormalEducationSection::firstOrCreate(
                ['area_id' => $section['area_id'], 'section' => $section['section'], 'title' => $section['title']],
                \Arr::except($section, ['area_id', 'section', 'title'])
            );
        }

        $this->command->info('✅ ' . count($sections) . ' secciones de educación formal creadas exitosamente.');
    }
}
