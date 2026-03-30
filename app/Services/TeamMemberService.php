<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Team;

class TeamMemberService
{
    public function getBySlug(string $slug): array
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

        $member = Team::where('slug', $slug)->where('status', true)->firstOrFail();

        return compact('banner', 'member');
    }
}