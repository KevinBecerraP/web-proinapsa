<?php

namespace App\Filament\Widgets;

use App\Models\Team;
use Filament\Widgets\Widget;

class TeamStatsWidget extends Widget
{
    protected static string $view = 'filament.widgets.team-stats-widget';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    public function getViewData(): array
    {
        return [
            'visibles' => Team::where('status', true)->count(),
            'ocultos'  => Team::where('status', false)->count(),
            'total'    => Team::count(),
        ];
    }
}
