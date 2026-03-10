<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Company;

class WhatWeDoService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'what_we_do')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $company = Company::first();

        $areas = Area::active()
            ->ordered()
            ->get();

        return compact('banner', 'company', 'areas');
    }
}
