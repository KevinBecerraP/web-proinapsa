<x-filament-widgets::widget>
    <x-filament::section>

        <div class="flex items-center gap-3 mb-4">
            <x-filament::icon icon="heroicon-o-user-group" class="h-6 w-6 text-primary-500"/>
            <div>
                <h2 class="text-base font-semibold" style="color:#111827;">Equipo</h2>
                <p class="text-sm" style="color:#6b7280;">Miembros registrados</p>
            </div>
        </div>

        {{-- Número grande --}}
        <div class="flex items-end gap-4 mb-4">
            <span class="text-5xl font-bold" style="color:#67B93E;">{{ $visibles }}</span>
            <span class="text-sm mb-2" style="color:#6b7280;">visibles en el sitio</span>
        </div>

        {{-- Detalle --}}
        <div class="flex gap-4 mb-4">
            <div class="flex items-center gap-2">
                <svg style="width:14px;height:14px;color:#67B93E;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm" style="color:#111827;">{{ $visibles }} visibles</span>
            </div>
            <div class="flex items-center gap-2">
                <svg style="width:14px;height:14px;color:#9ca3af;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm" style="color:#111827;">{{ $ocultos }} ocultos</span>
            </div>
        </div>

        <div class="border-t pt-3" style="border-color:#e5e7eb;">
            <a href="{{ route('filament.admin.resources.teams.index') }}"
               class="text-sm font-medium text-primary-500 hover:text-primary-600">
                Ver equipo →
            </a>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
