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

class ValuesResource extends Resource
{
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
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('order')
                                    ->label('Orden')
                                    ->type('number')
                                    ->default(function () {
                                        $maxOrder = Values::max('order');
                                        return $maxOrder ? $maxOrder + 1 : 1;
                                    })
                                    ->placeholder('Se asignará automáticamente si se deja vacío')
                                    ->prefixIcon('heroicon-o-numbered-list')
                                    ->helperText('Orden de visualización (debe ser único). Si no se especifica, se asignará el siguiente disponible.')
                                    ->extraInputAttributes(['min' => 1, 'step' => 1])
                                    ->integer()
                                    ->minValue(1)
                                    ->unique(
                                        table: 'values',
                                        column: 'order',
                                        ignoreRecord: true
                                    )
                                    ->validationMessages([
                                        'unique' => 'Ya existe un valor con este orden. Por favor, elige otro número.',
                                        'integer' => 'El orden debe ser un número entero positivo (1, 2, 3...).',
                                        'min' => 'El orden debe ser al menos 1.',
                                    ])
                                    ->dehydrateStateUsing(function ($state) {
                                        // Si está vacío, asignar el siguiente disponible
                                        if (empty($state) || $state === '' || $state === null) {
                                            $maxOrder = Values::max('order');
                                            return $maxOrder ? $maxOrder + 1 : 1;
                                        }
                                        // Convertir a entero para eliminar ceros a la izquierda
                                        return (int)$state;
                                    })
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
                    ->color('info'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->alignCenter(),
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
            ->defaultSort('order', 'asc')
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