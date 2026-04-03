<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditPublication extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = PublicationResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editPublication'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listPublications')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deletePublication')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
