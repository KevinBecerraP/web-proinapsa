<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        if (Company::count() > 0) {
            $this->command->warn('⚠️  Ya existe un registro de empresa. Se omite CompanySeeder.');
            return;
        }

        Company::create([
            'business_name'          => 'Instituto Proinapsa de Salud y Bienestar',
            'slogan'                 => 'Promoviendo la salud integral para todos',
            'phone_1'                => '(604) 444-5566',
            'phone_2'                => '(604) 444-5567',
            'phone_3'                => '300 123 4567',
            'phone_4'                => '310 987 6543',
            'phone_5'                => null,
            'email_1'                => 'contacto@proinapsa.edu.co',
            'email_2'                => 'informacion@proinapsa.edu.co',
            'email_3'                => 'investigacion@proinapsa.edu.co',
            'logo'                   => 'placeholder.jpg',
            'description'            => 'El Instituto Proinapsa es una institución comprometida con la promoción de la salud, la formación integral y el bienestar de las comunidades. Trabajamos con diferentes grupos poblacionales —primera infancia, niñez, mujeres y trabajadores— a través de programas de educación, investigación y proyección social. Nuestra labor está orientada a generar conocimiento aplicado y transformar realidades mediante el acompañamiento profesional y la construcción de entornos saludables.',
            'facebook_link'          => 'https://www.facebook.com/InstitutoProinapsa',
            'instagram_link'         => 'https://www.instagram.com/proinapsa_oficial',
            'youtube_link'           => 'https://www.youtube.com/@InstitutoProinapsa',
            'x_link'                 => 'https://x.com/proinapsa',
            'whatsapp_link'          => 'https://wa.me/573001234567',
            'threads_link'           => null,
            'address'                => 'Calle 50 # 42 - 78, Laureles, Medellín, Antioquia, Colombia',
            'privacy_policy_pdf'     => null,
            'video_link'             => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'latitude'               => '6.24421000',
            'longitude'              => '-75.58116000',

            // Misión
            'mission_title'          => 'Nuestra Misión',
            'mission_description'    => 'Promover la salud integral y el bienestar de las comunidades a través de procesos de educación, investigación y proyección social, con un enfoque humanista, científico y ético. Trabajamos para generar transformaciones positivas en la calidad de vida de los diferentes grupos poblacionales, especialmente en primera infancia, niñez, mujeres y trabajadores.',
            'mission_image'          => 'placeholder.jpg',

            // Visión
            'vision_title'           => 'Nuestra Visión',
            'vision_description'     => 'Para 2030, ser reconocidos como una institución de referencia nacional en la promoción de la salud, la formación integral y la investigación aplicada, contribuyendo de manera significativa al desarrollo humano sostenible y al bienestar de las comunidades colombianas.',
            'vision_image'           => 'placeholder.jpg',

            // Trayectoria
            'trajectory_title'       => 'Nuestra Trayectoria',
            'trajectory_description' => 'Desde nuestra fundación en 2005, el Instituto Proinapsa ha acompañado a miles de personas y comunidades en su camino hacia el bienestar. Con más de 18 años de experiencia, hemos desarrollado programas de formación, investigado problemáticas de salud pública y ejecutado proyectos de intervención comunitaria en todo el departamento de Antioquia. Nuestro recorrido está marcado por la pasión por servir, el rigor académico y el compromiso con la dignidad humana.',
            'trajectory_image'       => 'placeholder.jpg',

            // Metodología
            'methodology_title'       => 'Nuestra Metodología',
            'methodology_description' => '<p>En el Instituto Proinapsa aplicamos una metodología integrada que combina la teoría con la práctica, el conocimiento científico con el saber popular, y la acción individual con la transformación colectiva. Nuestro enfoque se basa en cuatro pilares fundamentales:</p><ul><li><strong>Participación activa:</strong> Involucramos a las comunidades como protagonistas de su propio bienestar.</li><li><strong>Interdisciplinariedad:</strong> Contamos con equipos de diferentes disciplinas que trabajan de forma colaborativa.</li><li><strong>Basado en evidencia:</strong> Nuestras intervenciones se fundamentan en investigación y buenas prácticas.</li><li><strong>Contextualización:</strong> Adaptamos nuestros programas a las realidades culturales y sociales de cada comunidad.</li></ul>',
            'methodology_image'       => 'placeholder.jpg',
        ]);

        $this->command->info('✅ Información de la empresa creada exitosamente.');
    }
}
