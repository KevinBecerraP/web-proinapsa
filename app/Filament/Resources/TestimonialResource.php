<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationLabel = 'Testimonios';

    protected static ?string $modelLabel = 'Testimonio';

    protected static ?string $pluralModelLabel = 'Testimonios';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Testimonio')
                    ->description('Datos de la persona y su opinión')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Ej: María García')
                                    ->prefixIcon('heroicon-o-user')
                                    ->validationMessages([
                                        'required' => 'El nombre es obligatorio.',
                                        'max'      => 'El nombre no puede exceder los 100 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('profile')
                                    ->label('Perfil')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Ej: Estudiante, Docente, Médico')
                                    ->prefixIcon('heroicon-o-briefcase')
                                    ->helperText('Cargo, profesión o rol de quien da el testimonio')
                                    ->validationMessages([
                                        'required' => 'El perfil es obligatorio.',
                                        'max'      => 'El perfil no puede exceder los 100 caracteres.',
                                    ]),

                                Forms\Components\Select::make('rating')
                                    ->label('Calificación')
                                    ->required()
                                    ->native(false)
                                    ->default(5)
                                    ->options([
                                        1 => '⭐ 1 estrella',
                                        2 => '⭐⭐ 2 estrellas',
                                        3 => '⭐⭐⭐ 3 estrellas',
                                        4 => '⭐⭐⭐⭐ 4 estrellas',
                                        5 => '⭐⭐⭐⭐⭐ 5 estrellas',
                                    ])
                                    ->prefixIcon('heroicon-o-star')
                                    ->helperText('Calificación general del testimonio')
                                    ->validationMessages([
                                        'required' => 'La calificación es obligatoria.',
                                    ]),

                                Forms\Components\Textarea::make('testimonial')
                                    ->label('Testimonio')
                                    ->required()
                                    ->rows(5)
                                    ->maxLength(600)
                                    ->placeholder('Escribe aquí el testimonio de la persona...')
                                    ->live(onBlur: true)
                                    ->hint(function ($state) {
                                        $length = strlen($state ?? '');
                                        return $length . ' / 600 caracteres';
                                    })
                                    ->hintColor(function ($state) {
                                        $length = strlen($state ?? '');
                                        $remaining = 600 - $length;
                                        if ($remaining < 60) return 'danger';
                                        if ($remaining < 120) return 'warning';
                                        return 'gray';
                                    })
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'El testimonio es obligatorio.',
                                        'max'      => 'El testimonio no puede exceder los 600 caracteres.',
                                    ]),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Configuración')
                    ->description('Orden y visibilidad en el sitio web')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->integer()
                                    ->default(fn () => (Testimonial::max('order') ?? 0) + 1)
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Posición de visualización. Se asigna automáticamente.')
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'required' => 'El orden es obligatorio.',
                                        'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                        'min'      => 'El orden debe ser mayor a 0.',
                                        'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                                    ]),

                                Forms\Components\Toggle::make('active')
                                    ->label('Activo')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Los testimonios inactivos no se mostrarán en el sitio web'),
                            ]),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('profile')
                    ->label('Perfil')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Calificación')
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),

                Tables\Columns\TextColumn::make('testimonial')
                    ->label('Testimonio')
                    ->searchable()
                    ->limit(60)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 60 ? $state : null;
                    }),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles'),

                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar testimonio'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar testimonio?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar testimonios seleccionados?')
                        ->modalDescription('Esta acción NO se puede deshacer.')
                        ->modalSubmitActionLabel('Sí, eliminar')
                        ->modalCancelActionLabel('Cancelar'),
                ])
                    ->label('Acciones')
                    ->icon('heroicon-o-ellipsis-vertical')
                    ->color('gray'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}
