<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function __construct(private HomeService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('index', $data);
    }
}