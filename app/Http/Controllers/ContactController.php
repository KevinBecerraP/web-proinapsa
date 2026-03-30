<?php

namespace App\Http\Controllers;

use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(private ContactService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('pages.contact.index', $data);
    }
}