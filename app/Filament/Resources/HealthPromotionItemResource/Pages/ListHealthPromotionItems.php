<?php

namespace App\Filament\Resources\HealthPromotionItemResource\Pages;

use App\Filament\Resources\HealthPromotionItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthPromotionItems extends ListRecords
{
    protected static string $resource = HealthPromotionItemResource::class;

    // Proteger el botón Crear
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->can('createHealthPromotionItem')),
        ];
    }
}
