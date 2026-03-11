<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AreaResource\Pages;
use App\Models\Area;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Áreas';

    protected static ?string $modelLabel = 'Área';

    protected static ?string $pluralModelLabel = 'Áreas';

    protected static ?int $navigationSort = 1;

    /**
     * Only allow creating if there are less than 3 areas
     */
    public static function canCreate(): bool
    {
        return Area::count() < 3;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Área')
                    ->description('Configuración general del área')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen del Área')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->required()
                            ->imageResizeTargetWidth('393')
                            ->imageResizeTargetHeight('390')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->maxSize(2048)
                            ->directory('areas/images')
                            ->nullable()
                            ->helperText('Solo JPG o PNG. Máximo 2 MB. Se redimensionará automáticamente a 393 × 390 px.')
                            ->columnSpanFull()
                            ->validationMessages([
                                'image'   => 'El archivo debe ser una imagen válida.',
                                'mimes'   => 'Solo se permiten imágenes JPG o PNG.',
                                'maxSize' => 'La imagen no puede superar los 2 MB.',
                            ]),

                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Ej: Educación y Comunicación')
                            ->prefixIcon('heroicon-o-tag')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El nombre del área es obligatorio.',
                                'max'      => 'El nombre no puede exceder los 100 caracteres.',
                                'unique'   => 'Ya existe un área con este nombre.',
                            ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->placeholder('ej: educacion-comunicacion')
                            ->helperText('Solo letras minúsculas, números y guiones')
                            ->prefixIcon('heroicon-o-link')
                            ->disabled() // No editable
                            ->dehydrated() // Pero sí se guarda
                            ->default(fn($get) => \Illuminate\Support\Str::slug($get('name')))
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Descripción')
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
                            ->placeholder('Escribe una descripción detallada del área...')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('icon')
                            ->label('Ícono (Heroicon)')
                            ->maxLength(100)
                            ->placeholder('heroicon-o-academic-cap')
                            ->helperText('Ejemplo: heroicon-o-academic-cap, heroicon-o-beaker, heroicon-o-heart')
                            ->prefixIcon('heroicon-o-sparkles')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('coordinator_id')
                            ->label('Coordinador')
                            ->relationship('coordinator', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona el coordinador del área')
                            ->helperText('El coordinador debe ser un miembro del equipo. Es obligatorio para guardar el área.')
                            ->prefixIcon('heroicon-o-user-circle')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El coordinador del área es obligatorio.',
                            ]),

                        Forms\Components\Toggle::make('active')
                            ->label('Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Las áreas inactivas no se mostrarán en el sitio web'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Descripciones — Educación y Comunicación')
                    ->description('Estos campos solo aplican al área de Educación y Comunicación. Son los textos introductorios de cada subsección del sitio web.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        // --- Educación Formal ---
                        Forms\Components\Fieldset::make('Educación Formal')
                            ->schema([
                                Forms\Components\FileUpload::make('formal_education_icon')
                                    ->label('Ícono')
                                    ->image()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('74')
                                    ->imageResizeTargetHeight('119')
                                    ->acceptedFileTypes(['image/png'])
                                    ->maxSize(2048)
                                    ->nullable()
                                    ->directory('areas/icons')
                                    ->helperText('Solo PNG. Máx. 2 MB. Se redimensionará a 74 × 119 px.')
                                    ->validationMessages([
                                        'mimes'   => 'Solo se permiten archivos PNG.',
                                        'maxSize' => 'El ícono no puede superar 2 MB.',
                                    ]),

                                Forms\Components\ColorPicker::make('formal_education_color')
                                    ->label('Color de tarjeta')
                                    ->placeholder('#000000')
                                    ->prefixIcon('heroicon-o-paint-brush'),

                                Forms\Components\Textarea::make('formal_education_description')
                                    ->label('Descripción')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->placeholder('Descripción introductoria de la educación formal...')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        // --- Educación No Formal ---
                        Forms\Components\Fieldset::make('Educación No Formal (Cursos)')
                            ->schema([
                                Forms\Components\FileUpload::make('non_formal_education_icon')
                                    ->label('Ícono')
                                    ->image()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('74')
                                    ->imageResizeTargetHeight('119')
                                    ->acceptedFileTypes(['image/png'])
                                    ->maxSize(2048)
                                    ->nullable()
                                    ->directory('areas/icons')
                                    ->helperText('Solo PNG. Máx. 2 MB. Se redimensionará a 74 × 119 px.')
                                    ->validationMessages([
                                        'mimes'   => 'Solo se permiten archivos PNG.',
                                        'maxSize' => 'El ícono no puede superar 2 MB.',
                                    ]),

                                Forms\Components\ColorPicker::make('non_formal_education_color')
                                    ->label('Color de tarjeta')
                                    ->placeholder('#000000')
                                    ->prefixIcon('heroicon-o-paint-brush'),

                                Forms\Components\Textarea::make('non_formal_education_description')
                                    ->label('Descripción')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->placeholder('Descripción introductoria de la educación no formal y cursos...')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        // --- Materiales de Educación y Comunicación ---
                        Forms\Components\Fieldset::make('Materiales de Educación y Comunicación')
                            ->schema([
                                Forms\Components\FileUpload::make('educational_materials_icon')
                                    ->label('Ícono')
                                    ->image()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('74')
                                    ->imageResizeTargetHeight('119')
                                    ->acceptedFileTypes(['image/png'])
                                    ->maxSize(2048)
                                    ->nullable()
                                    ->directory('areas/icons')
                                    ->helperText('Solo PNG. Máx. 2 MB. Se redimensionará a 74 × 119 px.')
                                    ->validationMessages([
                                        'mimes'   => 'Solo se permiten archivos PNG.',
                                        'maxSize' => 'El ícono no puede superar 2 MB.',
                                    ]),

                                Forms\Components\ColorPicker::make('educational_materials_color')
                                    ->label('Color de tarjeta')
                                    ->placeholder('#000000')
                                    ->prefixIcon('heroicon-o-paint-brush'),

                                Forms\Components\Textarea::make('educational_materials_description')
                                    ->label('Descripción')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->placeholder('Descripción introductoria de los materiales educativos...')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->collapsible()
                    ->collapsed(),
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
                    ->icon('heroicon-o-tag')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-o-link'),

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
            ->defaultSort('order', 'asc')
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
                    ->tooltip('Editar área'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAreas::route('/'),
            'create' => Pages\CreateArea::route('/create'),
            'edit' => Pages\EditArea::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}
