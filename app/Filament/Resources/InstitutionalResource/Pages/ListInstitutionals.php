<?php

namespace App\Filament\Resources\InstitutionalResource\Pages;

use App\Filament\Resources\InstitutionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstitutionals extends ListRecords
{
    protected static string $resource = InstitutionalResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createInstitutional')),
        ];
    }
}