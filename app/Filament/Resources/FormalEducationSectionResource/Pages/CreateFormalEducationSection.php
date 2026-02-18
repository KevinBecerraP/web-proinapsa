<?php

namespace App\Filament\Resources\FormalEducationSectionResource\Pages;

use App\Filament\Resources\FormalEducationSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormalEducationSection extends CreateRecord
{
     protected static string $resource = FormalEducationSectionResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createFormalEducationSection'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
