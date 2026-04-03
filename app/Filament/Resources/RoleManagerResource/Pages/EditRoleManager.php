<?php

namespace App\Filament\Resources\RoleManagerResource\Pages;

use App\Filament\Resources\RoleManagerResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\EditRecord;

class EditRoleManager extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = RoleManagerResource::class;
}
