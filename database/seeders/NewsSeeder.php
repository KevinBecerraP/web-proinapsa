<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsItems = [
            [
                'title'   => 'Proinapsa lanza nueva cohorte del Diplomado en Salud Mental Comunitaria',
                'excerpt' => 'El Instituto Proinapsa abre inscripciones para la quinta cohorte de su reconocido Diplomado en Salud Mental Comunitaria, con cupos limitados y modalidad híbrida.',
                'content' => '<p>El <strong>Instituto Proinapsa</strong> se complace en anunciar la apertura de inscripciones para la quinta cohorte del <em>Diplomado en Salud Mental Comunitaria</em>, uno de los programas de formación más reconocidos de la institución.</p><p>Este diplomado está dirigido a profesionales de la salud, trabajo social, psicología y ciencias humanas que deseen profundizar en estrategias de intervención en salud mental con enfoque comunitario. La formación tiene una duración de 6 meses, se desarrolla en modalidad híbrida y cuenta con el aval académico de instituciones de educación superior aliadas.</p><p>Entre los módulos del programa se incluyen: <strong>fundamentos de salud mental comunitaria</strong>, intervención en crisis, redes de apoyo social, salud mental y derechos humanos, y gestión de programas en salud mental.</p><p>Las inscripciones están abiertas hasta el 30 de abril. Para más información, comuníquese con nosotros a través de nuestro correo institucional o visítenos en nuestras instalaciones.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 1,
                'active'  => true,
            ],
            [
                'title'   => 'Resultados del estudio sobre bienestar psicológico en primera infancia antioqueña',
                'excerpt' => 'Investigadores de Proinapsa presentaron los resultados de un estudio de dos años sobre factores protectores del bienestar psicológico en niños de 0 a 6 años en zonas rurales de Antioquia.',
                'content' => '<p>El equipo de investigación del <strong>Instituto Proinapsa</strong> presentó los resultados de un estudio de dos años titulado <em>"Factores protectores del bienestar psicológico en primera infancia en zonas rurales de Antioquia"</em>, financiado por el Sistema General de Regalías.</p><p>La investigación, que involucró a 847 familias de 12 municipios del departamento, identificó que el <strong>vínculo afectivo seguro</strong> con los cuidadores principales, el acceso a espacios de juego y las redes de apoyo comunitario son los principales factores protectores del desarrollo socioemocional en los primeros años de vida.</p><p>Los resultados han sido publicados en la <em>Revista Colombiana de Salud Pública</em> y servirán de insumo para el diseño de políticas públicas de infancia en el departamento de Antioquia.</p><p>La presentación de resultados contó con la participación de representantes de la Gobernación de Antioquia, el ICBF regional y organizaciones de la sociedad civil.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 2,
                'active'  => true,
            ],
            [
                'title'   => 'Jornada de promoción de la salud llegó a 5 comunidades rurales de Antioquia',
                'excerpt' => 'El equipo de Proyección Social del Instituto Proinapsa realizó jornadas de salud gratuitas en 5 municipios de Antioquia, atendiendo a más de 1.200 personas.',
                'content' => '<p>Durante los últimos tres meses, el equipo de <strong>Proyección Social</strong> del Instituto Proinapsa realizó jornadas de promoción de la salud en los municipios de Ituango, Briceño, Valdivia, Tarazá y Caucasia, en el norte de Antioquia.</p><p>Las jornadas, completamente gratuitas, incluyeron actividades de <strong>tamizaje de salud mental</strong>, talleres de habilidades para la vida, charlas sobre nutrición y hábitos saludables, y sesiones de orientación psicosocial para familias.</p><p>En total, más de <em>1.200 personas</em> se beneficiaron de estas actividades, entre ellas mujeres gestantes, madres lactantes, niños y adultos mayores. Las jornadas contaron con el apoyo de las alcaldías municipales y centros de salud locales.</p><p>"Estas comunidades tienen una gran capacidad de resiliencia pero también necesidades urgentes de atención en salud mental y bienestar", señaló la Coordinadora de Proyección Social del instituto.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 3,
                'active'  => true,
            ],
            [
                'title'   => 'Proinapsa firma convenio con la Universidad de Antioquia para fortalecer la investigación',
                'excerpt' => 'El Instituto Proinapsa y la Facultad de Salud Pública de la Universidad de Antioquia firmaron un convenio de cooperación académica e investigativa por tres años.',
                'content' => '<p>En un acto solemne celebrado en el auditorio principal del Instituto Proinapsa, se firmó un <strong>Convenio de Cooperación Académica e Investigativa</strong> entre el instituto y la Facultad Nacional de Salud Pública de la Universidad de Antioquia.</p><p>Este convenio, con una vigencia de tres años, contempla la <strong>coinvestigación en proyectos de salud pública</strong>, la movilidad docente entre ambas instituciones, el intercambio de publicaciones científicas y la oferta de programas de formación conjuntos.</p><p>El rector del Instituto Proinapsa destacó que "este convenio nos permite articular el conocimiento científico de la universidad con nuestra experiencia en territorio, generando una sinergia que beneficiará directamente a las comunidades". Por su parte, el decano de la facultad subrayó la importancia de fortalecer los vínculos entre la academia y las organizaciones de la sociedad civil en el campo de la salud.</p><p>Como primer producto de la alianza, se desarrollará conjuntamente un estudio sobre salud mental en trabajadores del sector informal de Medellín.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 4,
                'active'  => true,
            ],
            [
                'title'   => 'Lanzamiento de guía de actividades lúdicas para el desarrollo infantil',
                'excerpt' => 'El área de Educación y Comunicación de Proinapsa presentó una nueva guía de actividades lúdicas diseñada para promover el desarrollo cognitivo, emocional y social en niños de 3 a 8 años.',
                'content' => '<p>El área de <strong>Educación y Comunicación</strong> del Instituto Proinapsa presentó oficialmente la publicación de la <em>Guía de Actividades Lúdicas para el Desarrollo Infantil Integral</em>, un material educativo diseñado para padres, cuidadores y docentes de primera infancia.</p><p>La guía, disponible de forma gratuita en el repositorio documental del instituto, contiene más de <strong>60 actividades lúdicas</strong> clasificadas por rango de edad (3-5 años y 6-8 años) y por área de desarrollo: cognitiva, socioemocional, motriz y comunicativa.</p><p>Cada actividad incluye descripción, materiales necesarios, instrucciones paso a paso y pautas de evaluación del desarrollo. El material fue desarrollado con el apoyo de psicólogos, pedagogos y trabajadores sociales del equipo de Proinapsa.</p><p>"Esta guía es el resultado de años de trabajo directo con familias y comunidades. Quisimos condensar ese conocimiento en una herramienta práctica y accesible para todos", explicó la coordinadora del proyecto.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 5,
                'active'  => true,
            ],
            [
                'title'   => 'Proinapsa participa en el XIII Congreso Colombiano de Salud Pública',
                'excerpt' => 'Investigadores y docentes del Instituto Proinapsa presentaron tres ponencias en el Congreso Colombiano de Salud Pública, celebrado en Bogotá.',
                'content' => '<p>Del 15 al 18 de octubre, representantes del <strong>Instituto Proinapsa</strong> participaron en el <em>XIII Congreso Colombiano de Salud Pública</em>, celebrado en el Centro de Convenciones de Bogotá con la participación de más de 2.000 profesionales del sector.</p><p>El instituto presentó <strong>tres ponencias</strong> en diferentes ejes temáticos del congreso:<br>1. <em>"Intervención psicosocial en comunidades afectadas por el conflicto armado en Antioquia"</em><br>2. <em>"Indicadores de bienestar en primera infancia: una propuesta de medición comunitaria"</em><br>3. <em>"Educación para la salud con enfoque intercultural en comunidades rurales"</em></p><p>Las ponencias recibieron una valoración muy positiva por parte de los asistentes y el comité científico del congreso. La participación de Proinapsa en este evento reafirma su posicionamiento como una institución de referencia en salud pública a nivel nacional.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 6,
                'active'  => true,
            ],
            [
                'title'   => 'Nuevo programa de apoyo psicológico para mujeres trabajadoras en situación de vulnerabilidad',
                'excerpt' => 'Proinapsa pone en marcha un programa gratuito de atención psicológica y orientación social para mujeres trabajadoras en situación de vulnerabilidad en Medellín.',
                'content' => '<p>El Instituto Proinapsa, en alianza con la Secretaría de las Mujeres de la Alcaldía de Medellín, pone en marcha el programa <em>"Mujeres Fuertes: Bienestar y Autonomía"</em>, una iniciativa de atención psicológica y orientación social completamente gratuita para mujeres trabajadoras en situación de vulnerabilidad.</p><p>El programa ofrece <strong>atención psicológica individual y grupal</strong>, talleres de empoderamiento económico, orientación jurídica básica y acompañamiento en la creación de redes de apoyo entre mujeres. Está dirigido especialmente a mujeres cabezas de hogar, víctimas del conflicto armado y trabajadoras del sector informal.</p><p>Las inscripciones están abiertas en las instalaciones del instituto y en las Casas de Justicia de los barrios La Candelaria, Manrique y Belén. Los cupos son limitados.</p><p>"Este programa es una respuesta concreta a las necesidades que identificamos en nuestros años de trabajo comunitario con mujeres", afirmó la directora del instituto.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 7,
                'active'  => true,
            ],
            [
                'title'   => 'Convocatoria abierta: Curso de Estrategias de Intervención Comunitaria en Salud',
                'excerpt' => 'Proinapsa abre inscripciones para el curso "Estrategias de Intervención Comunitaria en Salud", con modalidad virtual y certificado de participación.',
                'content' => '<p>El Instituto Proinapsa tiene el placer de anunciar la apertura de inscripciones para el curso <strong>"Estrategias de Intervención Comunitaria en Salud"</strong>, dirigido a profesionales y técnicos de las áreas de salud, trabajo social, educación y desarrollo comunitario.</p><p>Este curso de <strong>80 horas</strong> se desarrollará en modalidad completamente virtual, con clases en vivo los jueves y viernes de 6:00 p.m. a 9:00 p.m. a partir del próximo mes. Los contenidos incluyen:</p><ul><li>Marco conceptual de la intervención comunitaria en salud</li><li>Diagnóstico participativo y mapeo de actores</li><li>Diseño y gestión de proyectos de salud comunitaria</li><li>Comunicación para el cambio de comportamiento</li><li>Evaluación y sistematización de experiencias</li></ul><p>Al finalizar, los participantes recibirán un certificado de participación avalado por el Instituto Proinapsa. El valor de inscripción incluye acceso a todos los materiales del curso, grabación de las sesiones y tutoría virtual.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 8,
                'active'  => true,
            ],
            [
                'title'   => 'Publicación de nuevos materiales educativos digitales para adolescentes',
                'excerpt' => 'El área de Educación de Proinapsa presenta tres nuevos materiales educativos digitales dirigidos a adolescentes sobre salud sexual, salud mental y hábitos saludables.',
                'content' => '<p>El área de <strong>Educación y Comunicación</strong> del Instituto Proinapsa lanza tres nuevos materiales educativos digitales diseñados especialmente para adolescentes entre 12 y 17 años:</p><p><strong>1. "Hablemos de Salud Sexual con Respeto"</strong>: Guía interactiva sobre salud sexual y reproductiva desde una perspectiva de derechos, que aborda temas como consentimiento, identidad de género, métodos anticonceptivos y prevención de ITS.</p><p><strong>2. "Mi Mente también Importa"</strong>: Material de psicoeducación sobre salud mental adolescente, que incluye información sobre ansiedad, depresión, autolesiones y dónde buscar ayuda.</p><p><strong>3. "Rutinas que me Cuidan"</strong>: Guía práctica sobre hábitos saludables en la adolescencia: sueño, alimentación, actividad física y uso responsable de pantallas.</p><p>Todos los materiales están disponibles de forma gratuita en el repositorio del instituto y pueden ser descargados por docentes, orientadores escolares y padres de familia.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 9,
                'active'  => true,
            ],
            [
                'title'   => 'Proinapsa capacita a 200 trabajadores de la salud en gestión del estrés laboral',
                'excerpt' => 'A través de un programa intensivo de tres meses, el Instituto Proinapsa capacitó a 200 profesionales de la salud en estrategias de gestión del estrés y autocuidado.',
                'content' => '<p>En el marco del programa de <strong>Bienestar para Profesionales de la Salud</strong>, el Instituto Proinapsa completó exitosamente el proceso de capacitación de 200 trabajadores del sector salud en estrategias de gestión del estrés laboral y autocuidado.</p><p>El programa, desarrollado en alianza con tres instituciones hospitalarias de Medellín, tuvo una duración de tres meses e incluyó sesiones presenciales de taller, consulta psicológica individual y herramientas de seguimiento virtual.</p><p>Los participantes, entre los que se contaban médicos, enfermeros, auxiliares de enfermería y técnicos de diferentes servicios, reportaron una <strong>reducción significativa en los niveles de burnout</strong> y una mejora en la percepción de bienestar general al finalizar el proceso.</p><p>"El personal de salud cuida a los demás, pero también necesita ser cuidado. Este programa es nuestra contribución a ese propósito", afirmó el psicólogo coordinador del proceso en el instituto.</p>',
                'image'   => 'placeholder.jpg',
                'order'   => 10,
                'active'  => true,
            ],
        ];

        foreach ($newsItems as $news) {
            News::firstOrCreate(['title' => $news['title']], \Arr::except($news, ['title']));
        }

        $this->command->info('✅ ' . count($newsItems) . ' noticias creadas exitosamente.');
    }
}
