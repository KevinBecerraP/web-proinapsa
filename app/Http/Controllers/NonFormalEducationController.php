<?php

namespace App\Http\Controllers;

use App\Services\NonFormalEducationService;

class NonFormalEducationController extends Controller
{
    public function __construct(protected NonFormalEducationService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area, 'courses' => $courses] = $this->service->getAll();

        return view('pages.areas.educacion-comunicacion.educacion-no-formal.index', compact('banner', 'area', 'courses'));
    }
}