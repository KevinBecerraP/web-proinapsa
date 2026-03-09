<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name'        => 'Dra. María Elena González Ruiz',
                'position'    => 'Directora General',
                'description' => 'Psicóloga especialista en Salud Mental y Bienestar Comunitario con más de 20 años de experiencia en instituciones de educación y promoción de la salud. Lidera los procesos estratégicos del instituto con enfoque en el desarrollo integral de las comunidades.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Esp. Carlos Alberto Martínez López',
                'position'    => 'Coordinador de Investigación',
                'description' => 'Investigador en salud pública con amplia trayectoria en el diseño y ejecución de proyectos de investigación sobre promoción de la salud en contextos comunitarios e institucionales. Magíster en Epidemiología.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Lic. Ana Cristina Rodríguez Vargas',
                'position'    => 'Coordinadora de Educación y Comunicación',
                'description' => 'Especialista en pedagogía y comunicación para la salud, con experiencia en diseño de programas educativos y materiales didácticos para distintas poblaciones. Gestiona los procesos de formación formal y no formal del instituto.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Lic. Laura Patricia Sánchez Moreno',
                'position'    => 'Coordinadora de Proyección Social',
                'description' => 'Trabajadora social con enfoque en intervención comunitaria y promoción de derechos, especialmente en poblaciones vulnerables como primera infancia, niñez y mujeres. Coordina las estrategias de salud en territorio.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Psic. Juan David Pérez Hernández',
                'position'    => 'Psicólogo Institucional',
                'description' => 'Psicólogo clínico y organizacional con experiencia en atención individual y grupal. Enfocado en el bienestar emocional y la salud mental de los diferentes grupos poblacionales atendidos por el instituto.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Ts. Diana Marcela López Castro',
                'position'    => 'Trabajadora Social',
                'description' => 'Profesional en Trabajo Social especializada en intervención familiar y comunitaria, con énfasis en la promoción de entornos saludables y el fortalecimiento de redes de apoyo en comunidades rurales y urbanas.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
            [
                'name'        => 'Enf. Roberto Andrés Castillo Mejía',
                'position'    => 'Profesional de Salud Pública',
                'description' => 'Enfermero profesional con especialización en Salud Pública y Promoción de la Salud. Lidera los programas de atención en salud para trabajadores y comunidades en general, con énfasis en prevención de enfermedades.',
                'image'       => 'placeholder.jpg',
                'status'      => true,
            ],
        ];

        $createdTeams = [];
        foreach ($members as $member) {
            $createdTeams[] = Team::firstOrCreate(['name' => $member['name']], \Arr::except($member, ['name']));
        }

        // Asignar coordinadores a las áreas existentes
        $educationArea = Area::where('slug', 'educacion-comunicacion')->first();
        $researchArea  = Area::where('slug', 'investigacion')->first();
        $socialArea    = Area::where('slug', 'proyeccion-social')->first();

        if ($educationArea && isset($createdTeams[2])) {
            $educationArea->update(['coordinator_id' => $createdTeams[2]->id]);
        }
        if ($researchArea && isset($createdTeams[1])) {
            $researchArea->update(['coordinator_id' => $createdTeams[1]->id]);
        }
        if ($socialArea && isset($createdTeams[3])) {
            $socialArea->update(['coordinator_id' => $createdTeams[3]->id]);
        }

        $this->command->info('✅ ' . count($members) . ' miembros del equipo creados y coordinadores asignados a las áreas.');
    }
}
