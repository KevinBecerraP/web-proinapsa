<?php

namespace App\Filament\Resources\HealthPromotionItemResource\Pages;

use App\Filament\Resources\HealthPromotionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\RedirectsToIndex;

class CreateHealthPromotionItem extends CreateRecord
{
    use RedirectsToIndex;

     protected static string $resource = HealthPromotionItemResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createHealthPromotionItem'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
