<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeCardResource\Pages;
use App\Models\HomeCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class HomeCardResource extends Resource
{
    protected static ?string $model = HomeCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Contenido Web';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Tarjeta Home';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tarjetas Home';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Tarjeta')
                    ->description('Configura el contenido que se mostrará en la tarjeta del home')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(40)
                                    ->live(onBlur: true)
                                    ->placeholder('Ej: PROINAPSA en Cifras')
                                    ->prefixIcon('heroicon-o-pencil-square')
                                    ->helperText('Máximo 40 caracteres')
                                    ->validationMessages([
                                        'required' => 'El título es obligatorio.',
                                        'max' => 'El título no puede exceder los 40 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('icon')
                                    ->label('Ícono')
                                    ->maxLength(100)
                                    ->placeholder('heroicon-o-academic-cap')
                                    ->prefixIcon('heroicon-o-sparkles')
                                    ->helperText('Busca íconos en heroicons.com — escríbelo así: heroicon-o-nombre (outline) o heroicon-s-nombre (solid). Ej: heroicon-o-heart, heroicon-o-beaker, heroicon-o-academic-cap')
                                    ->validationMessages([
                                        'max' => 'El ícono no puede exceder los 100 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('button_text')
                                    ->label('Texto del Botón')
                                    ->required()
                                    ->maxLength(50)
                                    ->default('Ver más')
                                    ->placeholder('Ej: Descargar PDF')
                                    ->prefixIcon('heroicon-o-cursor-arrow-ripple')
                                    ->helperText('Texto que aparecerá en el botón')
                                    ->validationMessages([
                                        'required' => 'El texto del botón es obligatorio.',
                                        'max' => 'El texto no puede exceder los 50 caracteres.',
                                    ]),
                            ]),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->maxLength(150)
                            ->rows(3)
                            ->live(onBlur: true)
                            ->placeholder('Escribe una breve descripción...')
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 150 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 120 ? 'danger' : (strlen($state ?? '') > 100 ? 'warning' : 'gray'))
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La descripción es obligatoria.',
                                'max' => 'La descripción no puede exceder los 150 caracteres.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Tipo de Contenido')
                    ->description('Selecciona si será un PDF descargable o un enlace')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Tipo de Contenido')
                            ->required()
                            ->options([
                                'pdf' => 'Archivo PDF',
                                'url' => 'Enlace URL',
                            ])
                            ->native(false)
                            ->live()
                            ->prefixIcon('heroicon-o-document-arrow-down')
                            ->helperText('Selecciona el tipo de contenido que tendrá esta tarjeta')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'Debes seleccionar un tipo de contenido.',
                            ]),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('Archivo PDF')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->directory('home-cards/pdfs')
                            ->downloadable()

                            ->previewable(false)
                            ->visible(fn (Forms\Get $get) => $get('type') === 'pdf')
                            ->required(fn (Forms\Get $get) => $get('type') === 'pdf')
                            ->helperText('Máximo 10MB. Solo archivos PDF.')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'Debes subir un archivo PDF.',
                                'max' => 'El archivo no puede pesar más de 10MB.',
                                'mimes' => 'Solo se permiten archivos PDF.',
                            ])
                            ->afterStateUpdated(function ($state) {
                                if ($state) {
                                    Notification::make()
                                        ->title('¡PDF subido correctamente!')
                                        ->success()
                                        ->body('El archivo se ha guardado exitosamente.')
                                        ->send();
                                }
                            }),

                        Forms\Components\TextInput::make('url')
                            ->label('URL / Enlace')
                            ->prefixIcon('heroicon-o-link')
                            ->placeholder('https://ejemplo.com o /ruta-interna')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'url')
                            ->required(fn (Forms\Get $get) => $get('type') === 'url')
                            ->helperText('Puede ser una URL externa o una ruta interna del sitio')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'Debes ingresar una URL o enlace.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Configuración de Visualización')
                    ->description('Orden y estado de la tarjeta')
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
                                    ->default(fn () => (HomeCard::max('order') ?? 0) + 1)
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Posición de visualización. Se asigna automáticamente.')
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'required' => 'El orden es obligatorio.',
                                        'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                        'min'      => 'El orden debe ser mayor a 0.',
                                        'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                                    ]),

                                Forms\Components\Toggle::make('estado')
                                    ->label('¿Activa?')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Las tarjetas inactivas no se mostrarán en el home'),
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
                    ->color('success'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->title),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pdf' => 'PDF',
                        'url' => 'URL',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pdf' => 'danger',
                        'url' => 'success',
                    }),

                Tables\Columns\IconColumn::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('button_text')
                    ->label('Texto Botón')
                    ->limit(20)
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizada')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'pdf' => 'PDF',
                        'url' => 'URL',
                    ]),

                Tables\Filters\TernaryFilter::make('estado')
                    ->label('Estado')
                    ->placeholder('Todas')
                    ->trueLabel('Activas')
                    ->falseLabel('Inactivas'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar tarjeta'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar permanentemente?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar permanentemente?')
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
            'index' => Pages\ListHomeCards::route('/'),
            'create' => Pages\CreateHomeCard::route('/create'),
            'edit' => Pages\EditHomeCard::route('/{record}/edit'),
        ];
    }

    /**
     * Validación antes de crear: máximo 6 registros
     */
    public static function canCreate(): bool
    {
        $count = HomeCard::count();

        if ($count >= 3) {
            Notification::make()
                ->title('Límite alcanzado')
                ->warning()
                ->body('Solo se permiten 3 tarjetas en el home. Elimina una para poder crear una nueva.')
                ->persistent()
                ->send();

            return false;
        }

        return true;
    }
}