<?php

namespace Database\Seeders;

use App\Models\HomeCard;
use Illuminate\Database\Seeder;

class HomeCardSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            [
                'title'       => 'Cursos y Formación',
                'description' => 'Explora nuestro portafolio de cursos, diplomados y programas de formación continua en salud pública, bienestar comunitario y educación para la salud. Inscríbete hoy.',
                'type'        => 'url',
                'file_path'   => null,
                'url'         => 'https://www.proinapsa.edu.co/cursos',
                'button_text' => 'Ver cursos',
                'order'       => 1,
                'estado'      => true,
            ],
            [
                'title'       => 'Política de Privacidad',
                'description' => 'Consulta nuestra política de tratamiento de datos personales y privacidad. Conoce cómo protegemos tu información y cuáles son tus derechos como titular de datos.',
                'type'        => 'pdf',
                'file_path'   => 'placeholder.pdf',
                'url'         => null,
                'button_text' => 'Descargar PDF',
                'order'       => 2,
                'estado'      => true,
            ],
            [
                'title'       => 'Guía de Servicios',
                'description' => 'Descarga nuestra guía completa de servicios institucionales. Encuentra información sobre todos los programas, áreas de acción y formas de contacto del Instituto Proinapsa.',
                'type'        => 'pdf',
                'file_path'   => 'placeholder.pdf',
                'url'         => null,
                'button_text' => 'Descargar guía',
                'order'       => 3,
                'estado'      => true,
            ],
        ];

        foreach ($cards as $card) {
            HomeCard::firstOrCreate(['title' => $card['title']], \Arr::except($card, ['title']));
        }

        $this->command->info('✅ ' . count($cards) . ' tarjetas de inicio creadas (1 URL + 2 PDF).');
    }
}
