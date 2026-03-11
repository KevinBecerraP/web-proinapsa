<?php

namespace App\Http\Controllers;

use App\Services\SocialProjectionService;

class SocialProjectionController extends Controller
{
    public function __construct(protected SocialProjectionService $service) {}

    public function index()
    {
        ['banner' => $banner, 'area' => $area] = $this->service->getAll();

        return view('pages.areas.proyeccion-social.index', compact('banner', 'area'));
    }
}
