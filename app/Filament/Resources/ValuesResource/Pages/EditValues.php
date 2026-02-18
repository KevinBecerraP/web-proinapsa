<?php

namespace App\Filament\Resources\ValuesResource\Pages;

use App\Filament\Resources\ValuesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValues extends EditRecord
{
    protected static string $resource = ValuesResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editValues'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listValues')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteValues')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
