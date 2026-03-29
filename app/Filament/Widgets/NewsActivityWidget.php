<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Widgets\Widget;

class NewsActivityWidget extends Widget
{
    protected static string $view = 'filament.widgets.news-activity-widget';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    public function getViewData(): array
    {
        $latest      = News::latest('created_at')->first();
        $daysSince   = $latest ? (int) now()->diffInDays($latest->created_at) : null;
        $hasAlert    = $daysSince === null || $daysSince >= 30;

        return [
            'latest'    => $latest,
            'daysSince' => $daysSince,
            'hasAlert'  => $hasAlert,
            'total'     => News::count(),
        ];
    }
}
