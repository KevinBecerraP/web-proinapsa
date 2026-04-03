<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\RedirectsToIndex;

class CreateTestimonial extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = TestimonialResource::class;
    // Validar que el usuario tenga permiso para crear registros
    public function mount(): void
    {
    abort_unless(auth()->user()->can('createTestimonial'), 403);
    parent::mount();
    }
    // Redirigir a la lista después de guardar
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
