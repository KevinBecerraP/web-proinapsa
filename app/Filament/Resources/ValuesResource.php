<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValuesResource\Pages;
use App\Filament\Resources\ValuesResource\RelationManagers;
use App\Models\Values;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Traits\HasRoleAccess;

class ValuesResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = Values::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Valores';

    protected static ?string $modelLabel = 'Valor';

    protected static ?string $pluralModelLabel = 'Valores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Valor')
                    ->description('Datos del valor corporativo')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Integridad')
                                    ->prefixIcon('heroicon-o-tag')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'required' => 'El título del valor es obligatorio.',
                                        'max'      => 'El título no puede exceder los 255 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->integer()
                                    ->default(fn () => (Values::max('order') ?? 0) + 1)
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Posición de visualización. Se asigna automáticamente.')
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'required' => 'El orden es obligatorio.',
                                        'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                        'min'      => 'El orden debe ser mayor a 0.',
                                        'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                                    ])
                                    ->columnSpan(1),

                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción')
                                    ->required()
                                    ->rows(4)
                                    ->maxLength(500)
                                    ->placeholder('Describe el valor corporativo...')
                                    ->helperText('Descripción breve del valor (máximo 500 caracteres)')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set) {
                                        // Actualiza el contador en tiempo real
                                    })
                                    ->hint(function ($state) {
                                        $length = strlen($state ?? '');
                                        $remaining = 500 - $length;
                                        return $length . ' / 500 caracteres' . ($remaining < 50 ? ' ⚠️' : '');
                                    })
                                    ->hintColor(function ($state) {
                                        $length = strlen($state ?? '');
                                        $remaining = 500 - $length;
                                        if ($remaining < 50) return 'danger';
                                        if ($remaining < 100) return 'warning';
                                        return 'gray';
                                    })
                                    ->validationMessages([
                                        'max' => 'La descripción no puede tener más de 500 caracteres.',
                                        'required' => 'La descripción es obligatoria.',
                                    ])
                                    ->columnSpanFull(),

                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->description('Estado de visibilidad')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Estado')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Activa o desactiva la visualización de este valor en el sitio web')
                            ->columnSpanFull(),
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
                    ->alignCenter()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar valor?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar valores seleccionados?')
                        ->modalDescription('Esta acción NO se puede deshacer.')
                        ->modalSubmitActionLabel('Sí, eliminar')
                        ->modalCancelActionLabel('Cancelar'),
                ])
                    ->label('Acciones')
                    ->icon('heroicon-o-ellipsis-vertical')
                    ->color('gray'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListValues::route('/'),
            'create' => Pages\CreateValues::route('/create'),
            'edit' => Pages\EditValues::route('/{record}/edit'),
        ];
    }
}