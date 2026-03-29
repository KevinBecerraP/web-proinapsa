<x-filament-widgets::widget>
    <x-filament::section>

        <div class="flex items-center gap-3 mb-4">
            <x-filament::icon icon="heroicon-o-newspaper" class="h-6 w-6 text-primary-500"/>
            <div>
                <h2 class="text-base font-semibold" style="color:#111827;">Actividad de Noticias</h2>
                <p class="text-sm" style="color:#6b7280;">{{ $total }} noticias registradas</p>
            </div>
        </div>

        @if($hasAlert)
            {{-- Alerta --}}
            <div class="rounded-xl p-4 mb-4 flex items-start gap-3"
                 style="background-color:#fff7ed; border:1px solid #FFC31F;">
                <svg style="width:20px;height:20px;color:#FFC31F;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/>
                </svg>
                <div>
                    @if($daysSince === null)
                        <p class="text-sm font-semibold" style="color:#92400e;">No hay noticias publicadas aún</p>
                        <p class="text-sm" style="color:#92400e;">Publica tu primera noticia para mantener informados a tus usuarios.</p>
                    @else
                        <p class="text-sm font-semibold" style="color:#92400e;">Hace {{ $daysSince }} días sin publicar noticias</p>
                        <p class="text-sm" style="color:#92400e;">La última noticia fue "{{ \Illuminate\Support\Str::limit($latest->title, 45) }}".</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('filament.admin.resources.news.create') }}"
               class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white transition"
               style="background-color:#67B93E;">
                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Publicar noticia ahora
            </a>

        @else
            {{-- Todo bien --}}
            <div class="rounded-xl p-4 mb-4 flex items-start gap-3"
                 style="background-color:#f0fdf4; border:1px solid #67B93E;">
                <svg style="width:20px;height:20px;color:#67B93E;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold" style="color:#166534;">
                        Hace {{ $daysSince }} {{ $daysSince === 1 ? 'día' : 'días' }} — al día
                    </p>
                    <p class="text-sm" style="color:#166534;">
                        Última: "{{ \Illuminate\Support\Str::limit($latest->title, 45) }}"
                    </p>
                </div>
            </div>

            <div class="border-t pt-3" style="border-color:#e5e7eb;">
                <a href="{{ route('filament.admin.resources.news.index') }}"
                   class="text-sm font-medium text-primary-500 hover:text-primary-600">
                    Ver noticias →
                </a>
            </div>
        @endif

    </x-filament::section>
</x-filament-widgets::widget>
