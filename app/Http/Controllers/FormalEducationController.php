<?php

namespace App\Http\Controllers;

use App\Services\FormalEducationService;

class FormalEducationController extends Controller
{
    public function __construct(protected FormalEducationService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area, 'sections' => $sections] = $this->service->getAll();

        return view('pages.areas.educacion-comunicacion.educacion-formal.index', compact('banner', 'area', 'sections'));
    }
}
