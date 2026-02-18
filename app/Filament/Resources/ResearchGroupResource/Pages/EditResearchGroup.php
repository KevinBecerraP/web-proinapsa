<?php

namespace App\Filament\Resources\ResearchGroupResource\Pages;

use App\Filament\Resources\ResearchGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearchGroup extends EditRecord
{
    protected static string $resource = ResearchGroupResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editResearchGroup'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listResearchGroups')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteResearchGroup')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
