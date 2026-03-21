<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Cursos';

    protected static ?string $modelLabel = 'Curso';

    protected static ?string $pluralModelLabel = 'Cursos';

    protected static ?string $navigationGroup = 'Educación y Comunicación';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Configuración')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Estado')
                                    ->options([
                                        'active'   => 'Activo',
                                        'finished' => 'Finalizado',
                                        'inactive' => 'Inactivo',
                                    ])
                                    ->required()
                                    ->default('active')
                                    ->validationMessages([
                                        'required' => 'El estado del curso es obligatorio.',
                                    ]),

                                Forms\Components\TextInput::make('duration_hours')
                                    ->label('Duración (horas)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(1000)
                                    ->suffix('hrs')
                                    ->helperText('Opcional'),

                                Forms\Components\TextInput::make('registration_link')
                                    ->label('Link de Inscripción')
                                    ->url()
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('URL del formulario de inscripción')
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'El link de inscripción es obligatorio.',
                                        'max'      => 'El link no puede exceder los 255 caracteres.',
                                    ]),

                                Forms\Components\Select::make('area_id')
                                    ->label('Área')
                                    ->relationship('area', 'name')
                                    ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id)
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Forms\Components\Tabs\Tab::make('Vista Previa')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                                        $set('slug', Str::slug($state ?? ''))
                                    )
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'El título del curso es obligatorio.',
                                        'max'      => 'El título no puede exceder los 50 caracteres.',
                                        'unique'   => 'Ya existe un curso con este título.',
                                    ]),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(ignoreRecord: true)
                                    ->prefixIcon('heroicon-o-link')
                                    ->helperText('Se genera automáticamente a partir del título.')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Descripción Corta')
                                    ->required()
                                    ->maxLength(200)
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'La descripción corta es obligatoria.',
                                        'max'      => 'La descripción no puede exceder los 200 caracteres.',
                                    ]),

                                Forms\Components\FileUpload::make('main_image')
                                    ->label('Imagen Principal')
                                    ->image()
                                    ->directory('courses/images')
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->helperText('Máximo 2MB. Formatos: JPG, PNG')
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'La imagen principal es obligatoria.',
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Información Completa')
                            ->schema([
                                Forms\Components\RichEditor::make('full_description')
                                    ->label('Descripción Completa')
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'La descripción completa es obligatoria.',
                                    ])
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

                                Forms\Components\FileUpload::make('gallery_image_1')
                                    ->label('Imagen de Galería')
                                    ->image()
                                    ->directory('courses/gallery')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->helperText('Opcional. Solo JPG o PNG. Máximo 2MB')
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('Archivo PDF')
                                    ->directory('courses/pdfs')
                                    ->maxSize(3072)
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->helperText('Opcional. Máximo 3MB')
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),
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

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('status_label')
                    ->label('Estado')
                    ->badge()
                    ->color(fn ($record) => $record->status_badge_color),

                Tables\Columns\TextColumn::make('duration_hours')
                    ->label('Duración')
                    ->suffix(' hrs')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'active' => 'Activo',
                        'finished' => 'Finalizado',
                        'inactive' => 'Inactivo',
                    ]),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}