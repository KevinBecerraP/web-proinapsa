<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Equipo / Team';

    protected static ?string $modelLabel = 'Miembro del Equipo';

    protected static ?string $pluralModelLabel = 'Equipo';

    protected static ?string $navigationGroup = 'Institucional';

    protected static ?int $navigationSort = 41;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Miembro')
                    ->description('Datos del integrante del equipo')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Juan Pérez García')
                                    ->prefixIcon('heroicon-o-user')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'required' => 'El nombre es obligatorio.',
                                        'max'      => 'El nombre no puede exceder los 255 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('position')
                                    ->label('Cargo')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Director General')
                                    ->prefixIcon('heroicon-o-briefcase')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'required' => 'El cargo es obligatorio.',
                                        'max'      => 'El cargo no puede exceder los 255 caracteres.',
                                    ]),

                                Forms\Components\TextInput::make('profesion')
                                    ->label('Profesión')
                                    ->maxLength(150)
                                    ->placeholder('Ej: Psicóloga, Trabajadora Social')
                                    ->prefixIcon('heroicon-o-academic-cap')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'max' => 'La profesión no puede exceder los 150 caracteres.',
                                    ]),

                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(600)
                                    ->placeholder('Describe la experiencia y habilidades del miembro del equipo...')
                                    ->live(onBlur: true)
                                    ->hint(fn ($state) => strlen($state ?? '') . ' / 600 caracteres')
                                    ->hintColor(fn ($state) => strlen($state ?? '') > 540 ? 'danger' : (strlen($state ?? '') > 480 ? 'warning' : 'gray'))
                                    ->columnSpanFull()
                                    ->validationMessages([
                                        'required' => 'La descripción es obligatoria.',
                                        'max'      => 'La descripción no puede exceder los 600 caracteres.',
                                    ]),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Fotografía')
                    ->description('Imagen del miembro del equipo')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('393')
                            ->imageResizeTargetHeight('390')
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->directory('team')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('📐 Dimensión final: 393 × 390 px - La imagen se redimensionará automáticamente sin recortar. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La fotografía del miembro es obligatoria.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->description('Visibilidad del miembro en el sitio web')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Visible en el sitio')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Activa o desactiva la visualización de este miembro en el sitio web')
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('position')
                    ->label('Cargo')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('profesion')
                    ->label('Profesión')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),


                Tables\Columns\IconColumn::make('status')
                    ->label('Visible')
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
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Visibilidad')
                    ->placeholder('Todos')
                    ->trueLabel('Solo visibles')
                    ->falseLabel('Solo ocultos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles'),

                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar miembro'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar miembro')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar miembro del equipo?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar miembros seleccionados?')
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
            'index'  => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit'   => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
