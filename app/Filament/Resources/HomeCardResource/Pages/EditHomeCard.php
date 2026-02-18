<?php

namespace App\Filament\Resources\HomeCardResource\Pages;

use App\Filament\Resources\HomeCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeCard extends EditRecord
{
    protected static string $resource = HomeCardResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editHomeCard'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listHomeCards')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteHomeCard')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
