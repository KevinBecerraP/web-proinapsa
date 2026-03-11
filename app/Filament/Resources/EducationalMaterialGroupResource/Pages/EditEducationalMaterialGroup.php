<?php

namespace App\Filament\Resources\EducationalMaterialGroupResource\Pages;

use App\Filament\Resources\EducationalMaterialGroupResource;
use Filament\Resources\Pages\EditRecord;

class EditEducationalMaterialGroup extends EditRecord
{
    protected static string $resource = EducationalMaterialGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
