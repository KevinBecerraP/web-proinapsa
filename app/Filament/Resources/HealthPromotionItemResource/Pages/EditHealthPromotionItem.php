<?php

namespace App\Filament\Resources\HealthPromotionItemResource\Pages;

use App\Filament\Resources\HealthPromotionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditHealthPromotionItem extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = HealthPromotionItemResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editHealthPromotionItem'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listHealthPromotionItems')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteHealthPromotionItem')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
