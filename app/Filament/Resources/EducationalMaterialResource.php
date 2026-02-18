<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalMaterialResource\Pages;
use App\Models\EducationalMaterial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EducationalMaterialResource extends Resource
{
    protected static ?string $model = EducationalMaterial::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Materiales Educativos';

    protected static ?string $modelLabel = 'Material Educativo';

    protected static ?string $pluralModelLabel = 'Materiales Educativos';

    protected static ?string $navigationGroup = 'Educación y Comunicación';

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Clasificación')
                            ->schema([
                                Forms\Components\Select::make('area_id')
                                    ->label('Área')
                                    ->relationship('area', 'name')
                                    ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id)
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),

                                Forms\Components\Select::make('category')
                                    ->label('Categoría')
                                    ->options([
                                        'early_childhood' => 'Primera Infancia',
                                        'school_adolescence' => 'Escolar y Adolescencia',
                                    ])
                                    ->required()
                                    ->searchable(),

                                Forms\Components\Select::make('type')
                                    ->label('Tipo')
                                    ->options([
                                        'guides_manuals' => 'Guías y Manuales',
                                        'games' => 'Juegos',
                                    ])
                                    ->required()
                                    ->searchable(),
                            ])
                            ->columns(3),

                        Forms\Components\Tabs\Tab::make('Vista Previa')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, $get) {
                                        return $rule->where('category', $get('category'));
                                    })
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Descripción Corta')
                                    ->required()
                                    ->maxLength(200)
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('main_image')
                                    ->label('Imagen Principal')
                                    ->image()
                                    ->directory('educational-materials/images')
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('cover')
                                    ->helperText('Máximo 2MB. Formatos: JPG, PNG')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Contenido Completo')
                            ->schema([
                                Forms\Components\RichEditor::make('full_description')
                                    ->label('Descripción Completa')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'h2',
                                        'h3',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\Fieldset::make('Galería de Imágenes')
                                    ->schema([
                                        Forms\Components\FileUpload::make('gallery_image_1')
                                            ->label('Imagen 1')
                                            ->image()
                                            ->directory('educational-materials/gallery')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png']),

                                        Forms\Components\FileUpload::make('gallery_image_2')
                                            ->label('Imagen 2')
                                            ->image()
                                            ->directory('educational-materials/gallery')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png']),

                                        Forms\Components\FileUpload::make('gallery_image_3')
                                            ->label('Imagen 3')
                                            ->image()
                                            ->directory('educational-materials/gallery')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png']),

                                        Forms\Components\FileUpload::make('gallery_image_4')
                                            ->label('Imagen 4')
                                            ->image()
                                            ->directory('educational-materials/gallery')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png']),

                                        Forms\Components\FileUpload::make('gallery_image_5')
                                            ->label('Imagen 5')
                                            ->image()
                                            ->directory('educational-materials/gallery')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png']),
                                    ])
                                    ->columns(5),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('Archivo PDF')
                                    ->directory('educational-materials/pdfs')
                                    ->maxSize(3072)
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->helperText('Opcional. Máximo 3MB')
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Estado')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Activo')
                                    ->default(true)
                                    ->required(),
                            ]),
                    ])
                    ->columnSpanFull(),
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

                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Imagen')
                    ->circular(),

                Tables\Columns\TextColumn::make('category_label')
                    ->label('Categoría')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('type_label')
                    ->label('Tipo')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->weight('bold'),

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
                        'school_adolescence' => 'Escolar y Adolescencia',
                    ]),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'guides_manuals' => 'Guías y Manuales',
                        'games' => 'Juegos',
                    ]),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Activo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
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
            'index' => Pages\ListEducationalMaterials::route('/'),
            'create' => Pages\CreateEducationalMaterial::route('/create'),
            'edit' => Pages\EditEducationalMaterial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}