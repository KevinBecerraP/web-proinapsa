<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepositoryDocumentResource\Pages;
use App\Models\RepositoryDocument;
use App\Models\RepositoryCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use App\Filament\Traits\HasRoleAccess;

class RepositoryDocumentResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = RepositoryDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Repositorio';
    protected static ?int $navigationSort = 2;





    public static function getModelLabel(): string
    {
        return 'Documento';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Documentos del Repositorio';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Documento')
                    ->description('Datos del documento (guía, manual, etc.)')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\Select::make('repository_category_id')
                            ->label('Categoría')
                            ->relationship('category', 'title')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-folder-open')
                            ->validationMessages([
                                'required' => 'La categoría es obligatoria.',
                            ]),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->minLength(3)
                            ->maxLength(100)
                            ->placeholder('Ej: Guía de Prevención')
                            ->prefixIcon('heroicon-o-bookmark')
                            ->validationMessages([
                                'required' => 'El título del documento es obligatorio.',
                                'min'      => 'El título debe tener al menos 3 caracteres.',
                                'max'      => 'El título no puede exceder los 100 caracteres.',
                            ]),

                        Forms\Components\TextInput::make('authors')
                            ->label('Autoría')
                            ->maxLength(255)
                            ->placeholder('Ej: Juan Pérez, María López')
                            ->prefixIcon('heroicon-o-users'),

                        Forms\Components\TextInput::make('topic')
                            ->label('Tema')
                            ->maxLength(255)
                            ->placeholder('Ej: Salud, Educación, Prevención')
                            ->prefixIcon('heroicon-o-tag'),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(3)
                            ->maxLength(600)
                            ->placeholder('Descripción del documento...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 600 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 520 ? 'danger' : (strlen($state ?? '') > 420 ? 'warning' : 'gray'))
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La descripción del documento es obligatoria.',
                                'max'      => 'La descripción no puede exceder los 600 caracteres.',
                            ]),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(999)
                            ->integer()
                            ->default(fn () => (RepositoryDocument::max('order') ?? 0) + 1)
                            ->prefixIcon('heroicon-o-arrows-up-down')
                            ->helperText('Posición de visualización. Se asigna automáticamente.')
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El orden es obligatorio.',
                                'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                'min'      => 'El orden debe ser mayor a 0.',
                                'max'      => 'El orden no puede ser mayor a 999.',
                                'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                            ]),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Archivos')
                    ->description('Imagen y documento PDF')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen/Portada')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('393')
                            ->imageResizeTargetHeight('393')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->maxSize(2048)
                            ->required()
                            ->directory('repository/images')
                                    ->disk('public')
                            ->nullable()
                            ->helperText('Solo JPG o PNG. Máximo 2 MB. Se redimensionará automáticamente a 393 × 393 px.')
                            ->validationMessages([
                                'required'  => 'La imagen de portada es obligatoria.',
                                'image'     => 'El archivo debe ser una imagen válida.',
                                'mimes'     => 'Solo se permiten imágenes JPG o PNG.',
                                'maxSize'   => 'La imagen no puede superar los 2 MB.',
                            ]),

                        Forms\Components\FileUpload::make('document')
                            ->label('Documento PDF')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(3072)
                            ->directory('repository/documents')
                                    ->disk('public')
                            ->required()
                            ->nullable()
                            ->helperText('Solo PDF. Máximo 3 MB.')
                            ->validationMessages([
                                'required' => 'El documento PDF es obligatorio.',
                                'mimes'    => 'Solo se permiten archivos en formato PDF.',
                                'maxSize'  => 'El PDF no puede superar los 3 MB.',
                            ]),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Documento Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está activo, será visible en el repositorio'),
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
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('authors')
                    ->label('Autoría')
                    ->searchable()
                    ->limit(25)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('topic')
                    ->label('Tema')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoría')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\IconColumn::make('document')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->getStateUsing(fn($record) => !empty($record->document)),

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
                Tables\Filters\SelectFilter::make('repository_category_id')
                    ->label('Categoría')
                    ->relationship('category', 'title'),

                Tables\Filters\TernaryFilter::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos')
                    ->placeholder('Todos'),
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
                    ->tooltip('Editar documento')
                    ->visible(fn() => static::userCanEdit()),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar documento')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar documento?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
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
            'index' => Pages\ListRepositoryDocuments::route('/'),
            'create' => Pages\CreateRepositoryDocument::route('/create'),
            'edit' => Pages\EditRepositoryDocument::route('/{record}/edit'),
        ];
    }
}