<?php

namespace App\Filament\Resources\RepositoryCategoryResource\Pages;

use App\Filament\Resources\RepositoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepositoryCategory extends CreateRecord
{
    protected static string $resource = RepositoryCategoryResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createRepositoryCategory'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
