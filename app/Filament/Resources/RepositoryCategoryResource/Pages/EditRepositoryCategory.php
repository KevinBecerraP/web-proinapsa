<?php

namespace App\Filament\Resources\RepositoryCategoryResource\Pages;

use App\Filament\Resources\RepositoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepositoryCategory extends EditRecord
{
    protected static string $resource = RepositoryCategoryResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editRepositoryCategory'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listRepositoryCategories')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteRepositoryCategory')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
