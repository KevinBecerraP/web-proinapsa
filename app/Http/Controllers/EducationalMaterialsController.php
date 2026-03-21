<?php

namespace App\Http\Controllers;

use App\Services\EducationalMaterialsService;

class EducationalMaterialsController extends Controller
{
    public function __construct(protected EducationalMaterialsService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area, 'materials' => $materials, 'courses' => $courses] = $this->service->getAll();

        return view('pages.areas.educacion-comunicacion.materiales.index', compact('banner', 'area', 'materials', 'courses'));
    }
}