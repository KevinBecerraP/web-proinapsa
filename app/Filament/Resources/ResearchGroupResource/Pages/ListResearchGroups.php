<?php

namespace App\Filament\Resources\ResearchGroupResource\Pages;

use App\Filament\Resources\ResearchGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearchGroups extends ListRecords
{
    protected static string $resource = ResearchGroupResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createResearchGroup')),
        ];
    }
}
