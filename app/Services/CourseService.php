<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Course;

class CourseService
{
    public function getBySlug(string $slug): array
    {
        $banner = Banner::active()
            ->where('page', 'education_communication')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $course = Course::active()->where('slug', $slug)->firstOrFail();

        $related = Course::active()
            ->where('id', '!=', $course->id)
            ->inRandomOrder()
            ->limit(3)
            ->get(['id', 'title', 'main_image', 'duration_hours', 'slug']);

        return compact('banner', 'course', 'related');
    }
}