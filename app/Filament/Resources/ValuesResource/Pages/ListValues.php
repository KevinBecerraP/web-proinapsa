<?php

namespace App\Filament\Resources\ValuesResource\Pages;

use App\Filament\Resources\ValuesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValues extends ListRecords
{
    protected static string $resource = ValuesResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createValues')),
        ];
    }
}
