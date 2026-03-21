<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Publication;

class ResearchService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'research')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $area = Area::active()
            ->where('slug', 'investigacion')
            ->with([
                'researchGroup.researchLines',
                'coordinator',
            ])
            ->firstOrFail();

        $publications = Publication::active()
            ->where('area_id', $area->id)
            ->ordered()
            ->get();

        return compact('banner', 'area', 'publications');
    }
}
