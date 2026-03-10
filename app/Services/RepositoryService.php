<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\RepositoryCategory;
use App\Models\RepositoryDocument;

class RepositoryService
{
    public function getCategories(): array
    {
        $banner = Banner::active()
            ->where('page', 'repository')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();


        $categories = RepositoryCategory::active()
            ->ordered()
            ->get();

        return compact('banner', 'categories');
    }

    public function getDocumentsByCategory(string $slug): array
    {
        $banner = Banner::active()
            ->where('page', 'repository')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $category = RepositoryCategory::active()->where('slug', $slug)->firstOrFail();

        $documents = RepositoryDocument::active()
            ->ordered()
            ->where('repository_category_id', $category->id)
            ->get();

        return compact('banner', 'category', 'documents');
    }
}
