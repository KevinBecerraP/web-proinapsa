<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearchGroupResource\Pages;
use App\Models\ResearchGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ResearchGroupResource extends Resource
{
    protected static ?string $model = ResearchGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Grupo de Investigación';

    protected static ?string $modelLabel = 'Grupo de Investigación';

    protected static ?string $pluralModelLabel = 'Grupo de Investigación';

    protected static ?string $navigationGroup = 'Investigación';

    protected static ?int $navigationSort = 21;

    /**
     * Only allow creating if there are no records (Singleton)
     */
    public static function canCreate(): bool
    {
        return ResearchGroup::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Grupo de Investigación')
                    ->description('Solo puede existir un grupo de investigación en el sistema')
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->label('Área')
                            ->relationship('area', 'name')
                            ->default(fn () => \App\Models\Area::where('slug', 'investigacion')->first()?->id)
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('name')
                            ->label('Nombre del Grupo')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('mini_description')
                            ->label('Mini Descripción')
                            ->required()
                            ->maxLength(300)
                            ->rows(3)
                            ->helperText('Descripción corta para vista previa')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
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

                        Forms\Components\TextInput::make('link')
                            ->label('Link (Opcional)')
                            ->url()
                            ->maxLength(255)
                            ->helperText('URL del sitio web del grupo (opcional)')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('active')
                            ->label('Activo')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Líneas de Investigación')
                    ->description('Temáticas principales en las que trabaja el grupo. Mínimo 2, sin límite máximo.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\Repeater::make('researchLines')
                            ->relationship()
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Línea de Investigación')
                                    ->required()
                                    ->maxLength(200)
                                    ->placeholder('Ej: Salud Pública')
                                    ->prefixIcon('heroicon-o-academic-cap')
                                    ->columnSpan(2)
                                    ->validationMessages([
                                        'required' => 'El título de la línea es obligatorio.',
                                        'max'      => 'No puede exceder los 200 caracteres.',
                                    ]),

                                Forms\Components\Toggle::make('active')
                                    ->label('Activa')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Las líneas inactivas no se mostrarán en el sitio web')
                                    ->columnSpan(1),

                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción (Opcional)')
                                    ->maxLength(300)
                                    ->rows(2)
                                    ->placeholder('Breve descripción de esta línea de investigación...')
                                    ->live(onBlur: true)
                                    ->hint(function ($state) {
                                        $length = strlen($state ?? '');
                                        return $length . ' / 300 caracteres';
                                    })
                                    ->hintColor(function ($state) {
                                        $remaining = 300 - strlen($state ?? '');
                                        if ($remaining < 30) return 'danger';
                                        if ($remaining < 60) return 'warning';
                                        return 'gray';
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->columns(3)
                            ->minItems(2)
                            ->reorderable('order')
                            ->addActionLabel('+ Agregar línea de investigación')
                            ->defaultItems(2)
                            ->collapsible()
                            ->cloneable(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Estadísticas')
                    ->schema([
                        Forms\Components\Placeholder::make('total_publications')
                            ->label('Total de Publicaciones')
                            ->content(fn ($record) => $record?->total_publications ?? 0)
                            ->helperText('Este contador se actualiza automáticamente según las publicaciones activas'),
                    ])
                    ->visible(fn ($record) => $record !== null),
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

                Tables\Columns\TextColumn::make('mini_description')
                    ->label('Descripción')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('total_publications')
                    ->label('Publicaciones')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-document-text'),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // No bulk actions for singleton
            ])
            ->emptyStateHeading('No hay grupo de investigación configurado')
            ->emptyStateDescription('Crea el grupo de investigación del instituto')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->disabled(fn () => ResearchGroup::count() > 0),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResearchGroups::route('/'),
            'create' => Pages\CreateResearchGroup::route('/create'),
            'edit' => Pages\EditResearchGroup::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['area', 'researchLines']);
    }
}