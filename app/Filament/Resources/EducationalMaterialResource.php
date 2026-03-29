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
                Forms\Components\Section::make('Clasificación')
                    ->description('Categoría y tipo del material educativo')
                    ->icon('heroicon-o-tag')
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
                                'childhood'       => 'Niñez',
                                'women'           => 'Mujer',
                                'workers'         => 'Trabajadores',
                            ])
                            ->required()
                            ->validationMessages([
                                'required' => 'La categoría es obligatoria.',
                            ]),

                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'guides_manuals' => 'Guías y Manuales',
                                'games'          => 'Juegos',
                            ])
                            ->required()
                            ->validationMessages([
                                'required' => 'El tipo de material es obligatorio.',
                            ]),
                    ])->columns(3)->collapsible(),

                Forms\Components\Section::make('Información del Material')
                    ->description('Datos que se mostrarán en el sitio web')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Ej: Guía de Prevención Temprana')
                            ->prefixIcon('heroicon-o-bookmark')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El título del material es obligatorio.',
                                'max'      => 'El título no puede exceder los 100 caracteres.',
                            ]),

                        Forms\Components\Textarea::make('short_description')
                            ->label('Descripción')
                            ->required()
                            ->maxLength(300)
                            ->rows(4)
                            ->placeholder('Descripción del material educativo...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 300 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 250 ? 'danger' : (strlen($state ?? '') > 200 ? 'warning' : 'gray'))
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La descripción es obligatoria.',
                                'max'      => 'La descripción no puede exceder los 300 caracteres.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Archivos')
                    ->description('Imagen y PDF del material')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('main_image')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('393')
                            ->imageResizeTargetHeight('390')
                            ->directory('educational-materials/images')
                                    ->disk('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->maxSize(2048)
                            ->required()
                            ->helperText('Solo JPG o PNG. Máximo 2 MB. Se redimensionará automáticamente a 393 × 390 px.')
                            ->validationMessages([
                                'required' => 'La imagen del material es obligatoria.',
                                'image'    => 'El archivo debe ser una imagen válida.',
                                'mimes'    => 'Solo se permiten imágenes JPG o PNG.',
                                'maxSize'  => 'La imagen no puede superar los 2 MB.',
                            ]),

                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('Archivo PDF')
                            ->directory('educational-materials/pdfs')
                                    ->disk('public')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['application/pdf'])

                            ->downloadable()
                            ->helperText('Opcional. Solo PDF. Máximo 3 MB.')
                            ->validationMessages([
                                'mimes'   => 'Solo se permiten archivos en formato PDF.',
                                'maxSize' => 'El PDF no puede superar los 3 MB.',
                            ]),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label('Material Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está inactivo, no se mostrará en el sitio web'),
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
                    ->limit(35)
                    ->weight('bold'),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'early_childhood' => 'Primera Infancia',
                        'childhood'       => 'Niñez',
                        'women'           => 'Mujer',
                        'workers'         => 'Trabajadores',
                    ]),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'guides_manuals' => 'Guías y Manuales',
                        'games'          => 'Juegos',
                    ]),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Activo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar material'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar material')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar material educativo?')
                    ->modalDescription('Esta acción NO se puede deshacer.'),
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
            'index'  => Pages\ListEducationalMaterials::route('/'),
            'create' => Pages\CreateEducationalMaterial::route('/create'),
            'edit'   => Pages\EditEducationalMaterial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}
