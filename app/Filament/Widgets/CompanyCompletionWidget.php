<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\Widget;

class CompanyCompletionWidget extends Widget
{
    protected static string $view = 'filament.widgets.company-completion-widget';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $company = Company::first();

        $sections = [
            'Información General' => [
                ['campo' => 'Razón Social',    'lleno' => !empty($company?->business_name)],
                ['campo' => 'Eslogan',         'lleno' => !empty($company?->slogan)],
                ['campo' => 'Descripción',     'lleno' => !empty($company?->description)],
                ['campo' => 'Dirección',       'lleno' => !empty($company?->address)],
            ],
            'Contacto' => [
                ['campo' => 'Teléfono',        'lleno' => !empty($company?->phone_1)],
                ['campo' => 'Email',           'lleno' => !empty($company?->email_1)],
                ['campo' => 'Latitud',         'lleno' => !empty($company?->latitude)],
                ['campo' => 'Longitud',        'lleno' => !empty($company?->longitude)],
            ],
            'Multimedia' => [
                ['campo' => 'Logo',            'lleno' => !empty($company?->logo)],
                ['campo' => 'Favicon',         'lleno' => !empty($company?->favicon)],
                ['campo' => 'Video',           'lleno' => !empty($company?->video_link)],
                ['campo' => 'Política PDF',    'lleno' => !empty($company?->privacy_policy_pdf)],
            ],
            'Misión' => [
                ['campo' => 'Título',          'lleno' => !empty($company?->mission_title)],
                ['campo' => 'Descripción',     'lleno' => !empty($company?->mission_description)],
                ['campo' => 'Imagen',          'lleno' => !empty($company?->mission_image)],
            ],
            'Visión' => [
                ['campo' => 'Título',          'lleno' => !empty($company?->vision_title)],
                ['campo' => 'Descripción',     'lleno' => !empty($company?->vision_description)],
                ['campo' => 'Imagen',          'lleno' => !empty($company?->vision_image)],
            ],
            'Trayectoria' => [
                ['campo' => 'Título',          'lleno' => !empty($company?->trajectory_title)],
                ['campo' => 'Descripción',     'lleno' => !empty($company?->trajectory_description)],
                ['campo' => 'Imagen',          'lleno' => !empty($company?->trajectory_image)],
            ],
            'Metodología' => [
                ['campo' => 'Título',          'lleno' => !empty($company?->methodology_title)],
                ['campo' => 'Descripción',     'lleno' => !empty($company?->methodology_description)],
                ['campo' => 'Imagen',          'lleno' => !empty($company?->methodology_image)],
            ],
        ];

        $total   = 0;
        $filled  = 0;

        foreach ($sections as &$fields) {
            foreach ($fields as &$field) {
                $total++;
                if ($field['lleno']) $filled++;
            }
        }

        $percentage = $total > 0 ? round(($filled / $total) * 100) : 0;

        return [
            'company'    => $company,
            'sections'   => $sections,
            'total'      => $total,
            'filled'     => $filled,
            'percentage' => $percentage,
        ];
    }
}
