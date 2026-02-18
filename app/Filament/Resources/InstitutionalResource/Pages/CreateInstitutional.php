<?php

namespace App\Filament\Resources\InstitutionalResource\Pages;

use App\Filament\Resources\InstitutionalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInstitutional extends CreateRecord
{
     protected static string $resource = InstitutionalResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createInstitutional'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
