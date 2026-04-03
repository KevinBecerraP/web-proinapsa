<?php

namespace App\Filament\Resources\PermissionManagerResource\Pages;

use App\Filament\Resources\PermissionManagerResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreatePermissionManager extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = PermissionManagerResource::class;
}
