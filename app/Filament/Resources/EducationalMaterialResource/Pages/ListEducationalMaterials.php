<?php

namespace App\Filament\Resources\EducationalMaterialResource\Pages;

use App\Filament\Resources\EducationalMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalMaterials extends ListRecords
{
    protected static string $resource = EducationalMaterialResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createEducationalMaterial')),
        ];
    }
}
