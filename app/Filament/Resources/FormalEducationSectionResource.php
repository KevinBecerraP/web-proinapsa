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

    // Solo se puede crear si aún no existen las 6 secciones
    public static function canCreate(): bool
    {
        return FormalEducationSection::count() < 6;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sección')
                    ->description('Selecciona a qué sección de educación formal corresponde este registro')
                    ->icon('heroicon-o-folder-open')
                    ->schema([
                        Forms\Components\Hidden::make('area_id')
                            ->default(fn () => \App\Models\Area::where('slug', 'educacion-comunicacion')->first()?->id)
                            ->required(),

                        Forms\Components\Select::make('section')
                            ->label('Sección')
                            ->options(function () {
                                $all = [
                                    'generalities'          => '📋 Generalidades',
                                    'modalities'            => '🎓 Modalidades',
                                    'procedures'            => '📝 Procedimientos',
                                    'access_conditions'     => '✅ Condiciones para Acceder',
                                    'intern_commitments'    => '👨‍🎓 Compromisos del Pasante',
                                    'institute_commitments' => '🏛️ Compromisos del Instituto',
                                ];
                                // En edición se muestran todas; en creación solo las disponibles
                                return $all;
                            })
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-o-tag')
                            ->placeholder('Selecciona la sección')
                            ->columnSpanFull()
                            ->unique(table: 'formal_education_sections', column: 'section', ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'La sección es obligatoria.',
                                'unique'   => 'Ya existe un registro para esta sección. Solo se permite uno por sección.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Archivos')
                    ->description('Ícono PNG y PDF de la sección')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Ícono')
                            ->image()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('35')
                            ->imageResizeTargetHeight('40')
                            ->directory('formal-education/icons')
                            ->acceptedFileTypes(['image/png'])
                            ->maxSize(1024)
                            ->required()
                            ->helperText('Solo PNG. Máximo 1 MB. Se redimensionará automáticamente a 35 × 40 px.')
                            ->validationMessages([
                                'required' => 'El ícono es obligatorio.',
                                'image'    => 'El archivo debe ser una imagen válida.',
                                'mimes'    => 'Solo se permiten archivos PNG.',
                                'maxSize'  => 'El ícono no puede superar 1 MB.',
                            ]),

                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('Archivo PDF')
                            ->directory('formal-education/pdfs')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['application/pdf'])
                            ->required()
                            ->openable()
                            ->downloadable()
                            ->helperText('Solo PDF. Máximo 3 MB.')
                            ->validationMessages([
                                'required' => 'El archivo PDF es obligatorio.',
                                'mimes'    => 'Solo se permiten archivos en formato PDF.',
                                'maxSize'  => 'El PDF no puede superar los 3 MB.',
                            ]),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado y Orden')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label('Sección Activa')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está inactiva, no se mostrará en el sitio web'),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(999)
                            ->integer()
                            ->default(fn () => (FormalEducationSection::max('order') ?? 0) + 1)
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
                    ->color('primary'),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Ícono')
                    ->square()
                    ->size(40),

                Tables\Columns\TextColumn::make('section_label')
                    ->label('Sección')
                    ->searchable(query: fn (Builder $query, string $search) =>
                        $query->where('section', 'like', "%{$search}%")
                    )
                    ->sortable(query: fn (Builder $query, string $direction) =>
                        $query->orderBy('section', $direction)
                    )
                    ->badge()
                    ->color('info'),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->getStateUsing(fn ($record) => !empty($record->pdf_file)),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('section')
                    ->label('Sección')
                    ->options([
                        'generalities'          => 'Generalidades',
                        'modalities'            => 'Modalidades',
                        'procedures'            => 'Procedimientos',
                        'access_conditions'     => 'Condiciones para Acceder',
                        'intern_commitments'    => 'Compromisos del Pasante',
                        'institute_commitments' => 'Compromisos del Instituto',
                    ]),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar sección'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar sección')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar sección?')
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
            'index'  => Pages\ListFormalEducationSections::route('/'),
            'create' => Pages\CreateFormalEducationSection::route('/create'),
            'edit'   => Pages\EditFormalEducationSection::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}
