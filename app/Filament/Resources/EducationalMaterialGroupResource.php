<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalMaterialGroupResource\Pages;
use App\Models\EducationalMaterialGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EducationalMaterialGroupResource extends Resource
{
    protected static ?string $model = EducationalMaterialGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Grupos de Materiales';

    protected static ?string $modelLabel = 'Grupo de Materiales';

    protected static ?string $pluralModelLabel = 'Grupos de Materiales';

    protected static ?string $navigationGroup = 'Educación y Comunicación';

    protected static ?int $navigationSort = 11;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Clasificación')
                    ->description('Categoría y tipo del grupo (no editables)')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Categoría (clave interna)')
                            ->options([
                                'early_childhood' => 'Primera Infancia',
                                'childhood'       => 'Niñez',
                                'women'           => 'Mujer',
                                'workers'         => 'Trabajadores',
                            ])
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'guides_manuals' => 'Guías y Manuales',
                                'games'          => 'Juegos',
                            ])
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\TextInput::make('display_name')
                            ->label('Nombre a mostrar en la sección')
                            ->maxLength(100)
                            ->placeholder('Ej: Primera Infancia')
                            ->helperText('Si lo dejas vacío, se usará el nombre por defecto de la categoría. Cambia esto si quieres mostrar un nombre diferente sin alterar la categoría.')
                            ->columnSpanFull(),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Información de la Tarjeta')
                    ->description('Datos que se mostrarán en la tarjeta del sitio web')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) =>
                                $set('slug', Str::slug($state ?? ''))
                            )
                            ->placeholder('Ej: Guías y Manuales — Primera Infancia')
                            ->prefixIcon('heroicon-o-bookmark')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El título es obligatorio.',
                                'max'      => 'El título no puede exceder los 100 caracteres.',
                            ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true)
                            ->prefixIcon('heroicon-o-link')
                            ->helperText('Se genera automáticamente a partir del título.')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción de la Tarjeta')
                            ->rows(3)
                            ->maxLength(300)
                            ->placeholder('Descripción corta que se muestra en la tarjeta...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 300 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 250 ? 'danger' : (strlen($state ?? '') > 200 ? 'warning' : 'gray'))
                            ->columnSpanFull()
                            ->validationMessages([
                                'max' => 'La descripción no puede exceder los 300 caracteres.',
                            ]),

                        Forms\Components\FileUpload::make('icon')
                            ->label('Ícono de la Tarjeta')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('200')
                            ->imageResizeTargetHeight('200')
                            ->directory('educational-materials/icons')
                                    ->disk('public')
                            ->acceptedFileTypes(['image/png'])
                            ->maxSize(1024)
                            ->nullable()
                            ->helperText('Se redimensionará automáticamente a 200 × 200 px. Solo PNG. Máximo 1 MB.')
                            ->columnSpan(1)
                            ->validationMessages([
                                'image'   => 'El archivo debe ser una imagen válida.',
                                'mimes'   => 'Solo se permiten archivos PNG.',
                                'maxSize' => 'El ícono no puede superar 1 MB.',
                            ]),

                        Forms\Components\ColorPicker::make('color')
                            ->label('Color de la Tarjeta')
                            ->nullable()
                            ->helperText('Color principal que tendrá la tarjeta en el sitio web.')
                            ->columnSpan(1),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado y Orden')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Grupo Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está inactivo, la tarjeta no se mostrará en el sitio web'),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(999)
                            ->integer()
                            ->default(fn () => (EducationalMaterialGroup::max('order') ?? 0) + 1)
                            ->prefixIcon('heroicon-o-arrows-up-down')
                            ->helperText('Posición de visualización (1–999).')
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El orden es obligatorio.',
                                'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                'min'      => 'El orden debe ser mayor a 0.',
                                'max'      => 'El orden no puede ser mayor a 999.',
                                'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                            ]),
                    ])->columns(2)->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('success'),


                Tables\Columns\ColorColumn::make('color')
                    ->label('Color'),

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
                    ->weight('bold')
                    ->limit(45),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar grupo'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationalMaterialGroups::route('/'),
            'edit'  => Pages\EditEducationalMaterialGroup::route('/{record}/edit'),
        ];
    }
}
