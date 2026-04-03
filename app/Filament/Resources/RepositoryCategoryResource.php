<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepositoryCategoryResource\Pages;
use App\Models\RepositoryCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use App\Filament\Traits\HasRoleAccess;

class RepositoryCategoryResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = RepositoryCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Repositorio';
    protected static ?int $navigationSort = 1;





    public static function getModelLabel(): string
    {
        return 'Categoría de Repositorio';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Categorías de Repositorio';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Categoría')
                    ->description('Datos de la categoría del repositorio')
                    ->icon('heroicon-o-folder-open')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Guías de Salud, Manuales Educativos')
                            ->prefixIcon('heroicon-o-bookmark')
                            ->validationMessages([
                                'required' => 'El título de la categoría es obligatorio.',
                                'max'      => 'El título no puede exceder los 255 caracteres.',
                            ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-o-link')
                            ->helperText('Se genera automáticamente a partir del título.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->integer()
                            ->default(fn () => (RepositoryCategory::max('order') ?? 0) + 1)
                            ->prefixIcon('heroicon-o-arrows-up-down')
                            ->helperText('Posición de visualización. Se asigna automáticamente.')
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El orden es obligatorio.',
                                'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                'min'      => 'El orden debe ser mayor a 0.',
                                'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                            ]),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->rows(4)
                            ->maxLength(750)
                            ->placeholder('Descripción de la categoría...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 750 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 650 ? 'danger' : (strlen($state ?? '') > 550 ? 'warning' : 'gray'))
                            ->columnSpanFull(),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Imagen')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen de la Categoría')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('1080')
                            ->imageResizeTargetHeight('1080')
                            ->directory('repository/categories')
                                    ->disk('public')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Se redimensionará automáticamente a 1080 × 1080 px. Formatos: JPG, PNG. Máx. 3MB')
                            ->nullable(),
                    ])->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Categoría Activa')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está activa, será visible en el repositorio'),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->alignCenter(),


                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('documents_count')
                    ->label('Documentos')
                    ->counts('documents')
                    ->badge()
                    ->color('info'),

                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueLabel('Activas')
                    ->falseLabel('Inactivas')
                    ->placeholder('Todas'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles')
                    ->visible(fn() => static::userCanList()),

                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar categoría')
                    ->visible(fn() => static::userCanEdit()),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar categoría')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar categoría?')
                    ->modalDescription('Se eliminarán también todos los documentos asociados.')
                    ->visible(fn() => static::userCanDelete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => static::userCanDelete()),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRepositoryCategories::route('/'),
            'create' => Pages\CreateRepositoryCategory::route('/create'),
            'edit' => Pages\EditRepositoryCategory::route('/{record}/edit'),
        ];
    }
}