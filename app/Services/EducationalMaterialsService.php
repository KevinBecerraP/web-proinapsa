<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Course;
use App\Models\EducationalMaterial;
use App\Models\EducationalMaterialGroup;

class EducationalMaterialsService
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

        $materials = EducationalMaterial::active()->ordered()
            ->where('area_id', $area->id)
            ->get();

        $groupIds = $materials->pluck('group_id')->unique()->filter();

        $groups = EducationalMaterialGroup::active()->ordered()
            ->whereIn('id', $groupIds)
            ->get();

        $courses = Course::active()
            ->where('area_id', $area->id)
            ->oldest()
            ->get();

        return compact('banner', 'area', 'groups', 'materials', 'courses');
    }
}