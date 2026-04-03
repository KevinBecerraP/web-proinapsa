<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditBanner extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = BannerResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editBanner'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listBanners')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteBanner')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
