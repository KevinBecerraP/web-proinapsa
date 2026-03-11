<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;

class EducationCommunicationService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'education_communication')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $area = Area::active()
            ->where('slug', 'educacion-comunicacion')
            ->with([
                'formalEducationSections' => fn($q) => $q->active()->ordered(),
                'courses'                 => fn($q) => $q->active()->ordered(),
                'educationalMaterials'    => fn($q) => $q->active()->ordered(),
                'coordinator',
            ])
            ->firstOrFail();

        return compact('banner', 'area');
    }
}
