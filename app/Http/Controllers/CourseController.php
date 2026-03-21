<?php

namespace App\Http\Controllers;

use App\Services\CourseService;

class CourseController extends Controller
{
    public function __construct(protected CourseService $service) {}

    public function show(string $slug)
    {
        ['banner' => $banner, 'course' => $course, 'related' => $related] = $this->service->getBySlug($slug);

        return view('pages.areas.educacion-comunicacion.educacion-no-formal.course', compact('banner', 'course', 'related'));
    }
}