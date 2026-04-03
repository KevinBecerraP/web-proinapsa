<?php

namespace App\Filament\Resources\PermissionManagerResource\Pages;

use App\Filament\Resources\PermissionManagerResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\EditRecord;

class EditPermissionManager extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = PermissionManagerResource::class;
}
