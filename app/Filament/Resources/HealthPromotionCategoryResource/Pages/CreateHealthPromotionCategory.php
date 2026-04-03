<?php

namespace App\Filament\Resources\HealthPromotionCategoryResource\Pages;

use App\Filament\Resources\HealthPromotionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\RedirectsToIndex;

class CreateHealthPromotionCategory extends CreateRecord
{
    use RedirectsToIndex;

     protected static string $resource = HealthPromotionCategoryResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createHealthPromotionCategory'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
