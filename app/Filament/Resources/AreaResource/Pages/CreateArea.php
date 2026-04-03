<?php

namespace App\Filament\Resources\AreaResource\Pages;

use App\Filament\Resources\AreaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\RedirectsToIndex;

class CreateArea extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = AreaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
