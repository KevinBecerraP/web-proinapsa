<?php

namespace App\Filament\Resources\FormalEducationSectionResource\Pages;

use App\Filament\Resources\FormalEducationSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormalEducationSections extends ListRecords
{
    protected static string $resource = FormalEducationSectionResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createFormalEducationSection')),
        ];
    }
}
