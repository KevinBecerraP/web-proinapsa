<?php

namespace App\Filament\Resources\RoleManagerResource\Pages;

use App\Filament\Resources\RoleManagerResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateRoleManager extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = RoleManagerResource::class;
}
