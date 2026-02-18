<?php

namespace App\Filament\Resources\RepositoryCategoryResource\Pages;

use App\Filament\Resources\RepositoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepositoryCategories extends ListRecords
{
    protected static string $resource = RepositoryCategoryResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createRepositoryCategory')),
        ];
    }
}
