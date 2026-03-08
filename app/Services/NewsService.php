<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\News;

class NewsService
{
    public function getAll(): array
    {
        $banner = Banner::active()
            ->where('page', 'news')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $news = News::active()
            ->ordered()
            ->with('createdBy:id,name')
            ->get(['id', 'title', 'excerpt', 'image', 'created_at', 'created_by', 'order']);

        $recentNews = News::active()
            ->latest()
            ->limit(5)
            ->get(['id', 'title', 'image', 'created_at']);

        return compact('banner', 'news', 'recentNews');
    }

    public function getById(int $id): array
    {
        $banner = Banner::active()
            ->where('page', 'news')
            ->latest()
            ->first()
            ?? Banner::active()
                ->where('type', 'secondary')
                ->where('page', 'default')
                ->latest()
                ->first();

        $recentNews = News::active()
            ->latest()
            ->limit(5)
            ->get(['id', 'title', 'image', 'created_at']);

        $newsItem = News::active()->findOrFail($id);

        return compact('banner', 'recentNews', 'newsItem');
    }
}
