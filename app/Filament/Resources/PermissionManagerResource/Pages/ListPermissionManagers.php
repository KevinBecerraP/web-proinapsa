<?php

namespace App\Filament\Resources\PermissionManagerResource\Pages;

use App\Filament\Resources\PermissionManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermissionManagers extends ListRecords
{
    protected static string $resource = PermissionManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
