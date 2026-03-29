<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;
use App\Models\HomeCard;
use App\Models\Institutional;
use App\Models\News;
use App\Models\Testimonial;

class HomeService
{
    public function getAll(): array
    {
        $banners = Banner::active()
            ->where('type', 'main')
            ->orderBy('order', 'asc')
            ->get();

        $areas = Area::active()
            ->whereIn('slug', ['educacion-comunicacion', 'investigacion', 'proyeccion-social'])
            ->get(['id', 'name', 'slug', 'logo', 'icon']);

        $homeCards = HomeCard::active()->ordered()->get();

        $latestNews = News::active()->latest()->limit(6)->get();

        $testimonials = Testimonial::active()->ordered()->get();

        $partners = Institutional::active()->partners()->ordered()->get();

        return compact('banners', 'areas', 'homeCards', 'latestNews', 'testimonials', 'partners');
    }
}
