<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Company;

class ContactService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'contact_us')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $company = Company::first();

        return compact('banner', 'company');
    }
}
