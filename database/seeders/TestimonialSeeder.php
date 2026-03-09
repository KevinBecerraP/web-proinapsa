<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'        => 'Sandra Milena Ospina',
                'profile'     => 'Participante del Diplomado en Salud Mental',
                'testimonial' => 'El diplomado en Salud Mental superó todas mis expectativas. Los docentes son excelentes profesionales y el contenido es completamente aplicable a mi labor diaria como psicóloga de una institución educativa. Recomiendo ampliamente el Instituto Proinapsa a todos mis colegas.',
                'rating'      => 5,
                'order'       => 1,
                'active'      => true,
            ],
            [
                'name'        => 'Carlos Esteban Morales',
                'profile'     => 'Profesional de Salud Pública',
                'testimonial' => 'Gracias a los cursos de Proinapsa pude actualizar mis conocimientos en epidemiología y promoción de la salud. La metodología es muy práctica y el acompañamiento del equipo docente es constante. Sin duda, una institución de alto nivel académico.',
                'rating'      => 5,
                'order'       => 2,
                'active'      => true,
            ],
            [
                'name'        => 'María Fernanda Giraldo',
                'profile'     => 'Trabajadora Social, Alcaldía de Medellín',
                'testimonial' => 'Participé en el programa de intervención comunitaria y fue una experiencia transformadora. Aprendí herramientas concretas para trabajar con comunidades vulnerables. El equipo de Proinapsa es muy comprometido y siempre está dispuesto a orientar.',
                'rating'      => 5,
                'order'       => 3,
                'active'      => true,
            ],
            [
                'name'        => 'Andrés Felipe Restrepo',
                'profile'     => 'Licenciado en Educación, docente universitario',
                'testimonial' => 'Excelente institución. La formación que ofrece Proinapsa en educación para la salud es de primer nivel. Los materiales son actualizados, los profesores muy preparados y la plataforma funciona perfectamente. Completé dos cursos y ya estoy inscrito en el tercero.',
                'rating'      => 5,
                'order'       => 4,
                'active'      => true,
            ],
            [
                'name'        => 'Gloria Inés Zapata',
                'profile'     => 'Enfermera jefe, Clínica Las Américas',
                'testimonial' => 'El curso de Primeros Auxilios Psicológicos fue muy completo y práctico. Lo recomendé a todo mi equipo de enfermería. Proinapsa tiene una propuesta de formación muy pertinente para los profesionales de la salud que trabajamos en contextos de alta demanda.',
                'rating'      => 4,
                'order'       => 5,
                'active'      => true,
            ],
            [
                'name'        => 'Juliana Ríos Betancur',
                'profile'     => 'Madre comunitaria, ICBF',
                'testimonial' => 'Gracias a los talleres de primera infancia que ofrece Proinapsa, mejoré mucho mi manera de trabajar con los niños. Ahora entiendo mejor su desarrollo y puedo apoyarlos de manera más efectiva. Es una institución que realmente piensa en las comunidades.',
                'rating'      => 5,
                'order'       => 6,
                'active'      => true,
            ],
            [
                'name'        => 'Hernán Darío Cárdenas',
                'profile'     => 'Coordinador de Bienestar Laboral',
                'testimonial' => 'Contratamos a Proinapsa para desarrollar un programa de bienestar para nuestros colaboradores y los resultados fueron excelentes. El equipo es muy profesional, puntual y el impacto en el clima organizacional fue notorio desde los primeros talleres.',
                'rating'      => 5,
                'order'       => 7,
                'active'      => true,
            ],
            [
                'name'        => 'Patricia Lorena Muñoz',
                'profile'     => 'Investigadora independiente en salud',
                'testimonial' => 'Las publicaciones e investigaciones del Instituto Proinapsa son un referente en salud pública regional. Acceder a su repositorio documental es de gran valor para quienes trabajamos en investigación. Una institución seria y con rigor científico.',
                'rating'      => 4,
                'order'       => 8,
                'active'      => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::firstOrCreate(['name' => $testimonial['name']], \Arr::except($testimonial, ['name']));
        }

        $this->command->info('✅ ' . count($testimonials) . ' testimonios creados exitosamente.');
    }
}
