<?php

namespace App\Filament\Resources\ResearchGroupResource\Pages;

use App\Filament\Resources\ResearchGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResearchGroup extends CreateRecord
{
     protected static string $resource = ResearchGroupResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createResearchGroup'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
