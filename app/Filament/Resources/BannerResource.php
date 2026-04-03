<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Traits\HasRoleAccess;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;

class BannerResource extends Resource
{
    use HasRoleAccess;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Contenido';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Configuración')
                    ->description('Estado, tipo y orden del banner')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Estado')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Activa o desactiva el banner')
                                    ->columnSpan(1),

                                Forms\Components\Select::make('type')
                                    ->label('Tipo de Banner')
                                    ->required()
                                    ->options([
                                        'main' => 'Principal',
                                        'secondary' => 'Secundario'
                                    ])
                                    ->default('main')
                                    ->prefixIcon('heroicon-o-tag')
                                    ->searchable()
                                    ->live()
                                    ->afterStateUpdated(fn(Forms\Set $set) => $set('page', null))
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->visible(fn(callable $get) => $get('type') === 'main')
                                    ->required(fn(callable $get) => $get('type') === 'main')
                                    ->minValue(1)
                                    ->integer()
                                    ->default(fn () => (Banner::max('order') ?? 0) + 1)
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Posición de visualización. Se asigna automáticamente.')
                                    ->unique(
                                        table: 'banners',
                                        column: 'order',
                                        ignoreRecord: true
                                    )
                                    ->maxValue(999)
                                    ->validationMessages([
                                        'required' => 'El orden es obligatorio.',
                                        'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                        'min'      => 'El orden debe ser mayor a 0.',
                                        'max'      => 'El orden no puede ser mayor a 999.',
                                        'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                                    ])
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Select::make('page')
                            ->label('Página del Banner')
                            ->options(function (?Banner $record) {
                                $allPages = [
                                    'about_us'               => 'Quiénes Somos',
                                    'what_we_do'             => 'Qué Hacemos',
                                    'education_communication'=> 'Educación y Comunicación',
                                    'social_projection'      => 'Proyección Social',
                                    'research'               => 'Investigación',
                                    'publications'           => 'Publicaciones',
                                    'research_group'         => 'Grupo de Investigación',
                                    'repository'             => 'Repositorios',
                                    'news'                   => 'Noticias',
                                    'contact_us'             => 'Contáctenos',
                                ];

                                $usedPages = Banner::where('type', 'secondary')
                                    ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                    ->pluck('page')
                                    ->toArray();

                                return collect($allPages)
                                    ->filter(fn($label, $key) => !in_array($key, $usedPages))
                                    ->toArray();
                            })
                            ->prefixIcon('heroicon-o-document')
                            ->searchable()
                            ->visible(fn(callable $get) => $get('type') === 'secondary')
                            ->required(fn(callable $get) => $get('type') === 'secondary')
                            ->unique(
                                table: 'banners',
                                column: 'page',
                                ignoreRecord: true,
                                modifyRuleUsing: fn (Unique $rule) => $rule->where('type', 'secondary')
                            )
                            ->validationMessages([
                                'unique' => 'Ya existe un banner secundario asignado a esta página. Solo se permite uno por página.',
                            ])
                            ->helperText('Selecciona la página donde se mostrará este banner. Solo puede haber un banner por página.')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Información del Banner')
                    ->description('Contenido principal y textos del banner')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Ej: Ofertas de Temporada')
                                    ->prefixIcon('heroicon-o-document-text')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'required' => 'El título del banner es obligatorio.',
                                        'max'      => 'El título no puede exceder los 100 caracteres.',
                                    ]),

                                Forms\Components\ColorPicker::make('title_color')
                                    ->label('Color del Título')
                                    ->required()
                                    ->default('#000000')
                                    ->placeholder('#000000')
                                    ->prefixIcon('heroicon-o-paint-brush')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('subtitle')
                                    ->label('Subtítulo')
                                    ->maxLength(60)
                                    ->live()
                                    ->hint(fn ($state) => strlen($state ?? '') . ' / 60 caracteres')
                                    ->hintColor(fn ($state) => strlen($state ?? '') >= 55 ? 'warning' : 'gray')
                                    ->placeholder('Ej: Hasta 50% de descuento')
                                    ->prefixIcon('heroicon-o-document-text')
                                    ->visible(fn(callable $get) => $get('type') !== 'secondary')
                                    ->columnSpan(1)
                                    ->validationMessages([
                                        'max' => 'El subtítulo no puede exceder los 60 caracteres.',
                                    ]),

                                Forms\Components\ColorPicker::make('subtitle_color')
                                    ->label('Color del Subtítulo')
                                    ->required(fn(callable $get) => $get('type') !== 'secondary')
                                    ->default('#000000')
                                    ->placeholder('#000000')
                                    ->prefixIcon('heroicon-o-paint-brush')
                                    ->visible(fn(callable $get) => $get('type') !== 'secondary')
                                    ->columnSpan(1),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Imagen del Banner')
                    ->description('Imagen principal que se mostrará')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('960')
                            ->imagePreviewHeight('250')
                            ->directory('banners')
                                    ->disk('public')
                            ->maxSize(4096)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Se redimensionará automáticamente a 1920 × 960 px. Formatos: JPG, PNG. Máx: 4MB')
                            ->visible(fn(callable $get) => $get('type') === 'main' || !$get('type'))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('500')
                            ->imagePreviewHeight('250')
                            ->directory('banners')
                                    ->disk('public')
                            ->maxSize(4096)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Se redimensionará automáticamente a 1920 × 500 px. Formatos: JPG, PNG. Máx: 4MB')
                            ->visible(fn(callable $get) => $get('type') === 'secondary')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Botón de Acción')
                    ->description('Configuración del botón (opcional)')
                    ->icon('heroicon-o-cursor-arrow-rays')
                    ->visible(fn(callable $get) => $get('type') !== 'secondary')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('button_link')
                                    ->label('Enlace del Botón')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://ejemplo.com/oferta')
                                    ->prefixIcon('heroicon-o-link')
                                    ->live(onBlur: true)
                                    ->columnSpan(1),

                                Forms\Components\ColorPicker::make('button_color')
                                    ->label('Color del Botón')
                                    ->placeholder('#0066CC')
                                    ->prefixIcon('heroicon-o-paint-brush')
                                    ->hidden(fn(callable $get) => !filled($get('button_link')))
                                    ->required(fn(callable $get) => filled($get('button_link')))
                                    ->columnSpan(1),
                            ]),
                    ])->collapsible(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'main' => 'Principal',
                        'secondary' => 'Secundario',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'main' => 'success',
                        'secondary' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('page')
                    ->label('Página')
                    ->formatStateUsing(fn($state): string => match($state) {
                        'about_us'                => 'Quiénes Somos',
                        'what_we_do'              => 'Qué Hacemos',
                        'education_communication' => 'Educación y Comunicación',
                        'social_projection'       => 'Proyección Social',
                        'research'                => 'Investigación',
                        'publications'            => 'Publicaciones',
                        'research_group'          => 'Grupo de Investigación',
                        'repository'              => 'Repositorios',
                        'news'                    => 'Noticias',
                        'contact_us'              => 'Contáctenos',
                        default                   => '-',
                    })
                    ->badge()
                    ->color('warning')
                    ->visible(fn($record) => $record?->type === 'secondary'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable()
                    ->placeholder('-'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'main' => 'Principal',
                        'secondary' => 'Secundario',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar banner'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar permanentemente?')
                    ->modalDescription('Esta acción NO se puede deshacer.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar permanentemente?')
                        ->modalDescription('Esta acción NO se puede deshacer.')
                        ->modalSubmitActionLabel('Sí, eliminar')
                        ->modalCancelActionLabel('Cancelar'),
                ])
                    ->label('Acciones')
                    ->icon('heroicon-o-ellipsis-vertical')
                    ->color('gray'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
