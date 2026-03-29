<?php

namespace App\Http\Controllers;

use App\Services\AboutService;

class AboutController extends Controller
{
    public function __construct(private AboutService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('pages.about.About-us', $data);
    }
}