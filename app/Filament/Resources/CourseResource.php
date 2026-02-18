<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                        Forms\Components\Tabs\Tab::make('Vista Previa')
                            ->schema([
                                Forms\Components\Select::make('area_id')
                                    ->label('Área')
                                    ->relationship('area', 'name')
                                    ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id)
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),

                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true)
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
                                    ->directory('courses/images')
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->helperText('Máximo 2MB. Formatos: JPG, PNG')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Información Completa')
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

                                Forms\Components\FileUpload::make('gallery_image_1')
                                    ->label('Imagen Galería 1')
                                    ->image()
                                    ->directory('courses/gallery')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->helperText('Opcional. Máximo 2MB'),

                                Forms\Components\FileUpload::make('gallery_image_2')
                                    ->label('Imagen Galería 2')
                                    ->image()
                                    ->directory('courses/gallery')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->helperText('Opcional. Máximo 2MB'),

                                Forms\Components\FileUpload::make('gallery_image_3')
                                    ->label('Imagen Galería 3')
                                    ->image()
                                    ->directory('courses/gallery')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->helperText('Opcional. Máximo 2MB'),

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
                            ->columns(3),

                        Forms\Components\Tabs\Tab::make('Configuración')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Estado')
                                    ->options([
                                        'active' => 'Activo',
                                        'finished' => 'Finalizado',
                                        'inactive' => 'Inactivo',
                                    ])
                                    ->required()
                                    ->default('active'),

                                Forms\Components\TextInput::make('registration_link')
                                    ->label('Link de Inscripción')
                                    ->url()
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('URL del formulario de inscripción')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('duration_hours')
                                    ->label('Duración (horas)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(1000)
                                    ->suffix('hrs')
                                    ->helperText('Opcional'),
                            ])
                            ->columns(2),
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
            ->defaultSort('order', 'asc')
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