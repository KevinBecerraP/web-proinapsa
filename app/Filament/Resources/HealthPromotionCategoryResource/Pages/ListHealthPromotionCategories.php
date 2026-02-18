<?php

namespace App\Filament\Resources\HealthPromotionCategoryResource\Pages;

use App\Filament\Resources\HealthPromotionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthPromotionCategories extends ListRecords
{
    protected static string $resource = HealthPromotionCategoryResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createHealthPromotionCategory')),
        ];
    }
}
