<?php

namespace App\Filament\Resources\RepositoryDocumentResource\Pages;

use App\Filament\Resources\RepositoryDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepositoryDocument extends EditRecord
{
    protected static string $resource = RepositoryDocumentResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editRepositoryDocument'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listRepositoryDocuments')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteRepositoryDocument')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
