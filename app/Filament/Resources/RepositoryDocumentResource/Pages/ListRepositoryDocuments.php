<?php

namespace App\Filament\Resources\RepositoryDocumentResource\Pages;

use App\Filament\Resources\RepositoryDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepositoryDocuments extends ListRecords
{
    protected static string $resource = RepositoryDocumentResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createRepositoryDocument')),
        ];
    }
}
