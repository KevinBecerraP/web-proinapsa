<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;

class SocialProjectionService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'social_projection')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $area = Area::active()
            ->where('slug', 'proyeccion-social')
            ->with([
                'healthPromotionCategories' => fn($q) => $q->active()->ordered()->with('items'),
                'publications'              => fn($q) => $q->active()->ordered(),
                'coordinator',
            ])
            ->firstOrFail();

        return compact('banner', 'area');
    }
}
