<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditTeam extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = TeamResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editTeam'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listTeams')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteTeam')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
