<?php

namespace App\Http\Controllers;

use App\Services\WhatWeDoService;

class WhatWeDoController extends Controller
{
    public function __construct(protected WhatWeDoService $whatWeDoService) {}

    public function index()
    {
        ['banner' => $banner, 'company' => $company, 'areas' => $areas] = $this->whatWeDoService->getAll();

        return view('pages.what-we-do.index', compact('banner', 'company', 'areas'));
    }
}
