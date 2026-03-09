<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // 3 BANNERS PRINCIPALES (type=main, page=default)
        // Aparecen en el slider principal de la home
        // =============================================
        $mainBanners = [
            [
                'page'           => 'default',
                'type'           => 'main',
                'title'          => 'Promovemos la Salud Integral',
                'title_color'    => '#FFFFFF',
                'subtitle'       => 'Programas de educación, investigación y proyección social para el bienestar de las comunidades',
                'subtitle_color' => '#F0F0F0',
                'image'          => 'placeholder.jpg',
                'button_link'    => '/sobre-nosotros',
                'button_color'   => '#F59E0B',
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'default',
                'type'           => 'main',
                'title'          => 'Formación que Transforma Vidas',
                'title_color'    => '#FFFFFF',
                'subtitle'       => 'Cursos, diplomados y programas de formación continua en salud pública y bienestar comunitario',
                'subtitle_color' => '#F0F0F0',
                'image'          => 'placeholder.jpg',
                'button_link'    => '/sobre-nosotros',
                'button_color'   => '#F59E0B',
                'status'         => true,
                'order'          => 2,
            ],
            [
                'page'           => 'default',
                'type'           => 'main',
                'title'          => 'Investigación con Impacto Social',
                'title_color'    => '#FFFFFF',
                'subtitle'       => 'Generamos conocimiento científico aplicado para responder a los desafíos de la salud en Colombia',
                'subtitle_color' => '#F0F0F0',
                'image'          => 'placeholder.jpg',
                'button_link'    => '/sobre-nosotros',
                'button_color'   => '#F59E0B',
                'status'         => true,
                'order'          => 3,
            ],
        ];

        // =============================================
        // BANNERS SECUNDARIOS (type=secondary)
        // Un banner por cada página del sistema
        // =============================================
        $secondaryBanners = [
            [
                'page'           => 'about_us',
                'type'           => 'secondary',
                'title'          => 'Quiénes Somos',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Más de 18 años promoviendo la salud y el bienestar en las comunidades de Antioquia',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'what_we_do',
                'type'           => 'secondary',
                'title'          => 'Lo Que Hacemos',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Educación, investigación y proyección social al servicio del bienestar humano',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'social_projection',
                'type'           => 'secondary',
                'title'          => 'Proyección Social',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Llegamos a las comunidades con programas de salud diseñados para cada grupo poblacional',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'education_communication',
                'type'           => 'secondary',
                'title'          => 'Educación y Comunicación',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Formación de calidad para profesionales y comunidades comprometidas con la salud',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'research',
                'type'           => 'secondary',
                'title'          => 'Investigación',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Producción de conocimiento científico riguroso para la toma de decisiones en salud pública',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'repository',
                'type'           => 'secondary',
                'title'          => 'Repositorio Documental',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Accede a nuestra colección de guías, manuales, investigaciones y documentos de política en salud',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'news',
                'type'           => 'secondary',
                'title'          => 'Noticias e Información',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Mantente informado sobre nuestras actividades, eventos y publicaciones más recientes',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'contact_us',
                'type'           => 'secondary',
                'title'          => 'Contáctanos',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Estamos aquí para atenderte. Escríbenos, llámanos o visítanos en nuestras instalaciones',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
            [
                'page'           => 'default',
                'type'           => 'secondary',
                'title'          => 'Instituto Proinapsa',
                'title_color'    => '#1F2937',
                'subtitle'       => 'Salud, conocimiento y bienestar para todos',
                'subtitle_color' => '#4B5563',
                'image'          => 'placeholder.jpg',
                'button_link'    => null,
                'button_color'   => null,
                'status'         => true,
                'order'          => 1,
            ],
        ];

        $total = 0;
        foreach ($mainBanners as $banner) {
            Banner::firstOrCreate(
                ['page' => $banner['page'], 'type' => $banner['type'], 'title' => $banner['title']],
                \Arr::except($banner, ['page', 'type', 'title'])
            );
            $total++;
        }
        foreach ($secondaryBanners as $banner) {
            Banner::firstOrCreate(
                ['page' => $banner['page'], 'type' => $banner['type'], 'title' => $banner['title']],
                \Arr::except($banner, ['page', 'type', 'title'])
            );
            $total++;
        }

        $this->command->info('✅ ' . $total . ' banners creados (3 principales + 9 secundarios).');
    }
}
