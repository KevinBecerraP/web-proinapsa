<?php

namespace App\Filament\Resources\EducationalMaterialResource\Pages;

use App\Filament\Resources\EducationalMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditEducationalMaterial extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = EducationalMaterialResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editEducationalMaterial'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listEducationalMaterials')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteEducationalMaterial')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
