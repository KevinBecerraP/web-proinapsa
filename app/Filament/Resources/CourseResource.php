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

use App\Filament\Traits\HasRoleAccess;

class CourseResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Educación No Formal';

    protected static ?string $modelLabel = 'Educación No Formal';

    protected static ?string $pluralModelLabel = 'Educación No Formal';

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

                                Forms\Components\Hidden::make('area_id')
                                    ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id),
                            ])
                            ->columns(2),

                        Forms\Components\Tabs\Tab::make('Vista Previa')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(70)
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                                        $set('slug', Str::slug($state ?? ''))
                                    )
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'El título del curso es obligatorio.',
                                        'max'      => 'El título no puede exceder los 70 caracteres.',
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
                                    ->live(onBlur: true)
                                    ->hint(fn ($state) => strlen($state ?? '') . ' / 200 caracteres')
                                    ->hintColor(fn ($state) => strlen($state ?? '') > 170 ? 'danger' : (strlen($state ?? '') > 140 ? 'warning' : 'gray'))
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'La descripción corta es obligatoria.',
                                        'max'      => 'La descripción no puede exceder los 200 caracteres.',
                                    ]),

                                Forms\Components\FileUpload::make('main_image')
                                    ->label('Imagen Principal')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('courses/images')
                                    ->disk('public')
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('390')
                                    ->imageResizeTargetHeight('220')
                                    ->helperText('Se redimensionará automáticamente a 390 × 220 px. Formatos: JPG, PNG. Máx. 2MB')
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
                                    ->live(onBlur: true)
                                    ->hint(fn ($state) => strlen(strip_tags($state ?? '')) . ' / 1000 caracteres')
                                    ->hintColor(fn ($state) => strlen(strip_tags($state ?? '')) > 900 ? 'danger' : (strlen(strip_tags($state ?? '')) > 800 ? 'warning' : 'gray'))
                                    ->rules([
                                        fn () => fn (string $attribute, $value, $fail) =>
                                            strlen(strip_tags($value ?? '')) > 1000
                                                ? $fail('La descripción completa no puede exceder los 1000 caracteres de texto visible.')
                                                : null,
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
                                    ->validationMessages([
                                        'required' => 'La descripción completa es obligatoria.',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('gallery_image_1')
                                    ->label('Imagen de Galería')
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('1600')
                                    ->directory('courses/gallery')
                                    ->disk('public')
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->helperText('Se redimensionará automáticamente a 1200 × 1600 px. Formatos: JPG, PNG. Máx 2MB')
                                    ->validationMessages([
                                        'required' => 'La imagen de galería es obligatoria.',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('Archivo PDF')
                                    ->directory('courses/pdfs')
                                    ->disk('public')
                                    ->maxSize(3072)
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->helperText('Opcional. Máximo 3MB')

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
                    ->color('success'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

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
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label('')
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