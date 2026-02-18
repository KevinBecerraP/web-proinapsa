<?php

namespace App\Filament\Resources\ValuesResource\Pages;

use App\Filament\Resources\ValuesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateValues extends CreateRecord
{
    protected static string $resource = ValuesResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createValues'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
