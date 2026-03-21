<?php

namespace App\Http\Controllers;

use App\Services\ResearchService;

class ResearchController extends Controller
{
    public function __construct(protected ResearchService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area, 'publications' => $publications] = $this->service->getAll();

        return view('pages.areas.investigacion.index', compact('banner', 'area', 'publications'));
    }
}
