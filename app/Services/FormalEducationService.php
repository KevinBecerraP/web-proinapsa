<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;
use App\Models\FormalEducationSection;

class FormalEducationService
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

        $area = Area::active()->where('slug', 'educacion-comunicacion')->firstOrFail();

        $sections = FormalEducationSection::active()->ordered()
            ->where('area_id', $area->id)
            ->get();

        return compact('banner', 'area', 'sections');
    }
}
