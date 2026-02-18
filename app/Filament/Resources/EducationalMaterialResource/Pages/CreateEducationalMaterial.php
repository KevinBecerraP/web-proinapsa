<?php

namespace App\Filament\Resources\EducationalMaterialResource\Pages;

use App\Filament\Resources\EducationalMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEducationalMaterial extends CreateRecord
{
    protected static string $resource = EducationalMaterialResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createEducationalMaterial'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
