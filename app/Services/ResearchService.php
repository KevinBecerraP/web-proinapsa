<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;

class ResearchService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'investigacion')
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
                'publications' => fn($q) => $q->active()->ordered(),
                'coordinator',
            ])
            ->firstOrFail();

        return compact('banner', 'area');
    }
}
