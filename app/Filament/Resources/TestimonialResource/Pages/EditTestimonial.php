<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\RedirectsToIndex;

class EditTestimonial extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = TestimonialResource::class;

    // Validar permiso para editar
    public function mount(int | string $record): void
    {
        abort_unless(auth()->user()->can('editTestimonial'), 403);
        parent::mount($record);
    }
    // Proteger acciones del header (Ver y Eliminar)
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->can('listTestimonials')),
            Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->can('deleteTestimonial')),
        ];
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
