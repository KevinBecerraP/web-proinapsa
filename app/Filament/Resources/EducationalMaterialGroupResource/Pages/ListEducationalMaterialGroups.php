<?php

namespace App\Filament\Resources\EducationalMaterialGroupResource\Pages;

use App\Filament\Resources\EducationalMaterialGroupResource;
use Filament\Resources\Pages\ListRecords;

class ListEducationalMaterialGroups extends ListRecords
{
    protected static string $resource = EducationalMaterialGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
