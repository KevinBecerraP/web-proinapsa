<?php

namespace App\Filament\Resources\EducationalMaterialGroupResource\Pages;

use App\Filament\Resources\EducationalMaterialGroupResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditEducationalMaterialGroup extends EditRecord
{
    use RedirectsToIndex;

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
