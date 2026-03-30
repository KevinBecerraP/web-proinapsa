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

        $relatedMembers = Team::where('status', true)
            ->where('id', '!=', $member->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return compact('banner', 'member', 'relatedMembers');
    }
}