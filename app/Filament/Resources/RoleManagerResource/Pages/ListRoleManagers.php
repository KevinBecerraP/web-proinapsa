<?php

namespace App\Filament\Resources\RoleManagerResource\Pages;

use App\Filament\Resources\RoleManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoleManagers extends ListRecords
{
    protected static string $resource = RoleManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
