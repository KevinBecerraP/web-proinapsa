<?php

namespace App\Http\Controllers;

use App\Services\RepositoryService;

class RepositoryController extends Controller
{
    public function __construct(protected RepositoryService $repositoryService) {}

    public function index()
    {
        ['banner' => $banner, 'categories' => $categories] = $this->repositoryService->getCategories();

        return view('pages.categories.index', compact('banner', 'categories'));
    }

    public function show(string $slug)
    {
        ['banner' => $banner, 'category' => $category, 'documents' => $documents] = $this->repositoryService->getDocumentsByCategory($slug);

        return view('pages.categories.show', compact('banner', 'category', 'documents'));
    }
}
