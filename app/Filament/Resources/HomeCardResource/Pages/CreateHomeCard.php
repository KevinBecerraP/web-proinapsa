<?php

namespace App\Filament\Resources\HomeCardResource\Pages;

use App\Filament\Resources\HomeCardResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\RedirectsToIndex;

class CreateHomeCard extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = HomeCardResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createHomeCard'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
