<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthPromotionCategoryResource\Pages;
use App\Models\HealthPromotionCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class HealthPromotionCategoryResource extends Resource
{
    protected static ?string $model = HealthPromotionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Categorías de Salud';

    protected static ?string $modelLabel = 'Categoría de Promoción de Salud';

    protected static ?string $pluralModelLabel = 'Categorías de Promoción de Salud';

    protected static ?string $navigationGroup = 'Proyección Social';

    protected static ?int $navigationSort = 30;

    /**
     * Only allow creating if there are less than 4 categories (Fixed categories)
     */
    public static function canCreate(): bool
    {
        return HealthPromotionCategory::count() < 4;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Categoría')
                    ->description('Las 4 categorías fijas del sistema de promoción de salud')
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->label('Área')
                            ->relationship('area', 'name')
                            ->default(fn () => \App\Models\Area::where('slug', 'proyeccion-social')->first()?->id)
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'early_childhood' => 'Primera Infancia',
                                'childhood' => 'Niñez',
                                'women' => 'Mujer',
                                'workers' => 'Trabajadores',
                            ])
                            ->required()
                            ->searchable()
                            ->unique(ignoreRecord: true)
                            ->disabled(fn ($record) => $record !== null) // No se puede cambiar si ya existe
                            ->validationMessages([
                                'required' => 'La categoría es obligatoria.',
                                'unique'   => 'Esta categoría ya está registrada.',
                            ]),

                        Forms\Components\TextInput::make('display_name')
                            ->label('Nombre a Mostrar')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El nombre a mostrar es obligatorio.',
                                'max'      => 'El nombre no puede exceder los 100 caracteres.',
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen de la Categoría')
                            ->image()
                            ->directory('health-promotion/categories')
                            ->required()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->helperText('Máximo 2MB. Formatos: JPG, PNG')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La imagen de la categoría es obligatoria.',
                            ]),

                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('Archivo PDF (Opcional)')
                            ->directory('health-promotion/pdfs')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('PDF general de la categoría. Máximo 3MB')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('active')
                            ->label('Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Las categorías inactivas no se mostrarán en el sitio web'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Estadísticas')
                    ->schema([
                        Forms\Components\Placeholder::make('total_items')
                            ->label('Total de Ítems')
                            ->content(fn ($record) => $record?->total_items ?? 0)
                            ->helperText('Cantidad de ítems (viñetas) en esta categoría'),
                    ])
                    ->visible(fn ($record) => $record !== null),
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

                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular(),

                Tables\Columns\TextColumn::make('category_label')
                    ->label('Categoría')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('category', 'like', "%{$search}%");
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('category', $direction);
                    })
                    ->badge()
                    ->color('info')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('display_name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('total_items')
                    ->label('Ítems')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-list-bullet'),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'early_childhood' => 'Primera Infancia',
                        'childhood' => 'Niñez',
                        'women' => 'Mujer',
                        'workers' => 'Trabajadores',
                    ]),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Activo')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Eliminar Categoría')
                    ->modalDescription('¿Estás seguro? Esto eliminará todos los ítems relacionados.')
                    ->modalSubmitActionLabel('Sí, eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHealthPromotionCategories::route('/'),
            'create' => Pages\CreateHealthPromotionCategory::route('/create'),
            'edit' => Pages\EditHealthPromotionCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['area', 'items'])->ordered();
    }
}