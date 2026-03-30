<?php

namespace App\Http\Controllers;

use App\Services\TeamMemberService;

class TeamMemberController extends Controller
{
    public function __construct(private TeamMemberService $service) {}

    public function show(string $slug)
    {
        $data = $this->service->getBySlug($slug);
        return view('pages.about.team-member', $data);
    }
}