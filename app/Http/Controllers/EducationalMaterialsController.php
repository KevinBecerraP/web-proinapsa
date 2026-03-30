<?php

namespace App\Http\Controllers;

use App\Services\EducationalMaterialsService;

class EducationalMaterialsController extends Controller
{
    public function __construct(protected EducationalMaterialsService $service) {}

    public function index()
    {
        $data = $this->service->getAll();

        return view('pages.areas.educacion-comunicacion.materiales.index', $data);
    }
}