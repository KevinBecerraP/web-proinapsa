<?php

namespace App\Filament\Resources\FormalEducationSectionResource\Pages;

use App\Filament\Resources\FormalEducationSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormalEducationSection extends EditRecord
{
    protected static string $resource = FormalEducationSectionResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editFormalEducationSection'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listFormalEducationSections')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteFormalEducationSection')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
