<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormalEducationSectionResource\Pages;
use App\Models\FormalEducationSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FormalEducationSectionResource extends Resource
{
    protected static ?string $model = FormalEducationSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Educación Formal';

    protected static ?string $modelLabel = 'Sección de Educación Formal';

    protected static ?string $pluralModelLabel = 'Educación Formal';

    protected static ?string $navigationGroup = 'Educación y Comunicación';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Información General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                // Campo oculto para área (siempre Educación y Comunicación)
                                Forms\Components\Hidden::make('area_id')
                                    ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id)
                                    ->required(),

                                Forms\Components\Select::make('section')
                                    ->label('Sección')
                                    ->options([
                                        'generalities' => '📋 Generalidades',
                                        'modalities' => '🎓 Modalidades',
                                        'procedures' => '📝 Procedimientos',
                                        'intern_commitments' => '👨‍🎓 Compromisos del Pasante',
                                        'institute_commitments' => '🏛️ Compromisos del Instituto',
                                    ])
                                    ->required()
                                    ->searchable()
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-folder-open')
                                    ->placeholder('Selecciona la sección')
                                    ->helperText('Cada sección representa un apartado diferente de educación formal')
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'La sección es obligatoria.',
                                    ]),

                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, $get) {
                                        return $rule->where('section', $get('section'));
                                    })
                                    ->placeholder('Ej: Introducción a la educación formal')
                                    ->prefixIcon('heroicon-o-document-text')
                                    ->helperText('Máximo 50 caracteres. Debe ser único dentro de la sección')
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'El título es obligatorio.',
                                        'max'      => 'El título no puede exceder los 50 caracteres.',
                                        'unique'   => 'Ya existe un registro con este título en la misma sección.',
                                    ]),
                            ])
                            ->columns(2),

                        Forms\Components\Tabs\Tab::make('Contenido')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                Forms\Components\RichEditor::make('description')
                                    ->label('Descripción')
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'La descripción es obligatoria.',
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
                                    ->placeholder('Escribe el contenido detallado de esta sección...')
                                    ->helperText('Usa los botones de formato para estructurar el contenido')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Multimedia')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Imagen')
                                    ->image()
                                    ->directory('formal-education/images')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->helperText('📸 Formatos: JPG, PNG | Tamaño máximo: 2MB')
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('Archivo PDF')
                                    ->directory('formal-education/pdfs')
                                    ->maxSize(3072)
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->helperText('📄 Solo archivos PDF | Tamaño máximo: 3MB')
                                    ->openable()
                                    ->downloadable()
                                    ->previewable(false)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL Externa (Opcional)')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://ejemplo.com')
                                    ->prefixIcon('heroicon-o-link')
                                    ->helperText('🔗 Enlace externo relacionado con esta sección')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),

                        Forms\Components\Tabs\Tab::make('Estado')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Sección Activa')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Desactiva esta opción para ocultar la sección temporalmente'),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
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

                Tables\Columns\TextColumn::make('section_label')
                    ->label('Sección')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('section', 'like', "%{$search}%");
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('section', $direction);
                    })
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->weight('bold')
                    ->icon('heroicon-o-document-text')
                    ->iconColor('primary'),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

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
                Tables\Filters\SelectFilter::make('section')
                    ->label('Sección')
                    ->options([
                        'generalities' => 'Generalidades',
                        'modalities' => 'Modalidades',
                        'procedures' => 'Procedimientos',
                        'intern_commitments' => 'Compromisos del Pasante',
                        'institute_commitments' => 'Compromisos del Instituto',
                    ]),

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
                    ->tooltip('Editar sección'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar sección?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar secciones seleccionadas?')
                        ->modalDescription('Esta acción NO se puede deshacer.')
                        ->modalSubmitActionLabel('Sí, eliminar')
                        ->modalCancelActionLabel('Cancelar'),
                ])
                    ->label('Acciones')
                    ->icon('heroicon-o-ellipsis-vertical')
                    ->color('gray'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormalEducationSections::route('/'),
            'create' => Pages\CreateFormalEducationSection::route('/create'),
            'edit' => Pages\EditFormalEducationSection::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('area')->ordered();
    }
}