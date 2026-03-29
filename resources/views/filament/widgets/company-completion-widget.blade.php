<x-filament-widgets::widget>
    <x-filament::section>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <x-filament::icon
                    icon="heroicon-o-building-office-2"
                    class="h-6 w-6 text-primary-500"
                />
                <div>
                    <h2 class="text-base font-semibold" style="color: #111827;">
                        Información de la Empresa
                    </h2>
                    <p class="text-sm" style="color: #6b7280;">
                        {{ $filled }} de {{ $total }} campos completados
                    </p>
                </div>
            </div>

            {{-- Porcentaje con color inline --}}
            <div class="text-right">
                <span class="text-3xl font-bold" style="color: {{ $percentage > 90 ? '#67B93E' : ($percentage >= 50 ? '#FFC31F' : '#ef4444') }};">
                    {{ $percentage }}%
                </span>
            </div>
        </div>

        {{-- Barra de progreso --}}
        <div class="w-full rounded-full h-3 mb-6" style="background-color: #e5e7eb;">
            <div
                class="h-3 rounded-full transition-all duration-500"
                style="width: {{ $percentage }}%; background-color: {{ $percentage > 90 ? '#67B93E' : ($percentage >= 50 ? '#FFC31F' : '#ef4444') }};">
            </div>
        </div>

        @if(!$company)
            <div class="text-center py-4" style="color: #6b7280;">
                <p>No hay información de empresa registrada aún.</p>
            </div>
        @else
            {{-- Secciones --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($sections as $nombre => $campos)
                    <div class="rounded-xl p-3 border" style="background-color: #f9fafb; border-color: #e5e7eb;">
                        <h3 class="text-xs font-bold uppercase tracking-wider mb-2" style="color: #9ca3af;">
                            {{ $nombre }}
                        </h3>
                        <ul class="space-y-1">
                            @foreach($campos as $campo)
                                <li class="flex items-center gap-2 text-sm">
                                    @if($campo['lleno'])
                                        {{-- Chulo verde --}}
                                        <svg style="width:16px;height:16px;color:#22c55e;flex-shrink:0;" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        {{-- X roja --}}
                                        <svg style="width:16px;height:16px;color:#ef4444;flex-shrink:0;" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    <span style="color: #111827;">{{ $campo['campo'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            {{-- Link editar --}}
            <div class="mt-4 text-right">
                <a href="{{ route('filament.admin.resources.companies.edit', $company) }}"
                   class="text-sm font-medium text-primary-500 hover:text-primary-600">
                    Completar información →
                </a>
            </div>
        @endif

    </x-filament::section>
</x-filament-widgets::widget>
