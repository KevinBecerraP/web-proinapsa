<?php

namespace App\Filament\Resources\RepositoryDocumentResource\Pages;

use App\Filament\Resources\RepositoryDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepositoryDocument extends CreateRecord
{
    protected static string $resource = RepositoryDocumentResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createRepositoryDocument'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
