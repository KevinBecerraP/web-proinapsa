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

class RepositoryDocumentResource extends Resource
{
    protected static ?string $model = RepositoryDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Repositorio';
    protected static ?int $navigationSort = 2;

    private static function userCanList(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('listRepositoryDocuments') || $user->hasRole('SuperAdmin');
    }

    private static function userCanCreate(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('createRepositoryDocument') || $user->hasRole('SuperAdmin');
    }

    private static function userCanEdit(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('editRepositoryDocument') || $user->hasRole('SuperAdmin');
    }

    private static function userCanDelete(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('deleteRepositoryDocument') || $user->hasRole('SuperAdmin');
    }

    public static function canViewAny(): bool
    {
        return static::userCanList();
    }

    public static function canCreate(): bool
    {
        return static::userCanCreate();
    }

    public static function canEdit($record): bool
    {
        return static::userCanEdit();
    }

    public static function canDelete($record): bool
    {
        return static::userCanDelete();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

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
                            ->prefixIcon('heroicon-o-folder-open'),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Guía de Prevención')
                            ->prefixIcon('heroicon-o-bookmark'),

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
                            ->rows(3)
                            ->placeholder('Descripción del documento...')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->prefixIcon('heroicon-o-arrows-up-down'),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Archivos')
                    ->description('Imagen y documento PDF')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen/Portada')
                            ->image()
                            ->imageEditor()
                            ->directory('repository/images')
                            ->nullable()
                            ->helperText('Imagen representativa'),

                        Forms\Components\FileUpload::make('document')
                            ->label('Documento PDF')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('repository/documents')
                            ->nullable()
                            ->helperText('PDF de descarga gratuita'),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Documento Activo')
                            ->default(true)
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

                Tables\Columns\ImageColumn::make('image')
                    ->label('Portada')
                    ->square()
                    ->size(50),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
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
            ->defaultSort('order', 'asc')
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