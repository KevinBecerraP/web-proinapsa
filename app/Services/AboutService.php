<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Company;
use App\Models\Values;

class AboutService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'about_us')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $company = Company::first();

        $values = Values::active()->ordered()->get();

        return compact('banner', 'company', 'values');
    }
}