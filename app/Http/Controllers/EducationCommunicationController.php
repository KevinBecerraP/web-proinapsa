<?php

namespace App\Http\Controllers;

use App\Services\EducationCommunicationService;

class EducationCommunicationController extends Controller
{
    public function __construct(protected EducationCommunicationService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area] = $this->service->getAll();

        return view('pages.areas.educacion-comunicacion.index', compact('banner', 'area'));
    }
}
