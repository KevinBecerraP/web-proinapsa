<?php

namespace App\Http\Controllers;

use App\Services\NewsService;

class NewsController extends Controller
{
    public function __construct(protected NewsService $newsService) {}

    public function index()
    {
        ['banner' => $banner, 'news' => $news, 'recentNews' => $recentNews] = $this->newsService->getAll();

        return view('pages.news.index', compact('banner', 'news', 'recentNews'));
    }

    public function show(int $id)
    {
        ['banner' => $banner, 'recentNews' => $recentNews, 'newsItem' => $newsItem] = $this->newsService->getById($id);

        return view('pages.news.show', compact('banner', 'recentNews', 'newsItem'));
    }
}
