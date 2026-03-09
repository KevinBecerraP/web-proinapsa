<?php

namespace Database\Seeders;

use App\Models\Values;
use Illuminate\Database\Seeder;

class ValuesSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            [
                'title'       => 'Respeto',
                'description' => 'Reconocemos la dignidad y los derechos de cada persona, valorando la diversidad cultural, social y humana como fundamento de nuestras relaciones institucionales y comunitarias.',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'title'       => 'Integridad',
                'description' => 'Actuamos con honestidad, transparencia y coherencia en todos nuestros procesos, garantizando que nuestras acciones estén alineadas con los principios éticos y los compromisos adquiridos.',
                'order'       => 2,
                'status'      => true,
            ],
            [
                'title'       => 'Compromiso',
                'description' => 'Asumimos con responsabilidad y dedicación nuestra labor en favor del bienestar comunitario, aportando lo mejor de nuestra capacidad profesional y humana en cada proyecto que emprendemos.',
                'order'       => 3,
                'status'      => true,
            ],
            [
                'title'       => 'Innovación',
                'description' => 'Fomentamos el pensamiento creativo y la búsqueda constante de nuevas estrategias para responder a los desafíos de la salud y el bienestar, adaptándonos a los cambios del entorno con apertura y flexibilidad.',
                'order'       => 4,
                'status'      => true,
            ],
            [
                'title'       => 'Solidaridad',
                'description' => 'Trabajamos de manera colaborativa, apoyando a las comunidades más vulnerables y fortaleciendo los lazos de cooperación entre instituciones, profesionales y ciudadanos en torno a objetivos comunes de bienestar.',
                'order'       => 5,
                'status'      => true,
            ],
            [
                'title'       => 'Excelencia',
                'description' => 'Buscamos la mejora continua en la calidad de nuestros programas, servicios e investigaciones, orientándonos por altos estándares académicos, científicos y profesionales que generen impacto real en la sociedad.',
                'order'       => 6,
                'status'      => true,
            ],
        ];

        foreach ($values as $value) {
            Values::firstOrCreate(['title' => $value['title']], \Arr::except($value, ['title']));
        }

        $this->command->info('✅ ' . count($values) . ' valores institucionales creados exitosamente.');
    }
}
