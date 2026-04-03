<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = UserResource::class;
}
