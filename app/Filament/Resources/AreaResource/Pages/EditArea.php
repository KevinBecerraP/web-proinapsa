<?php

namespace App\Filament\Resources\AreaResource\Pages;

use App\Filament\Resources\AreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditArea extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = AreaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
