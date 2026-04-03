<?php

namespace App\Filament\Resources\InstitutionalResource\Pages;

use App\Filament\Resources\InstitutionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditInstitutional extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = InstitutionalResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editInstitutional'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listInstitutionals')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteInstitutional')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
