<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstitutionalResource\Pages;
use App\Filament\Traits\HasRoleAccess;
use App\Models\Institutional;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InstitutionalResource extends Resource
{
    use HasRoleAccess;

    const MAX_INTEREST_LINKS = 10;

    protected static ?string $model = Institutional::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Recursos Institucionales';

    protected static ?string $modelLabel = 'Recurso Institucional';

    protected static ?string $pluralModelLabel = 'Recursos Institucionales';

    protected static ?string $navigationGroup = 'Institucional';

    protected static ?int $navigationSort = 40;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Tipo de Recurso')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Tipo de Recurso')
                                    ->options(function (?Institutional $record) {
                                        $currentCount = Institutional::where('type', 'interest_link')
                                            ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                            ->count();
                                        $limitReached = $currentCount >= self::MAX_INTEREST_LINKS;
                                        return array_filter([
                                            'interest_link' => $limitReached ? null : '🔗 Link de Interés',
                                            'partner' => '🤝 Socio/Aliado',
                                        ]);
                                    })
                                    ->helperText(function (?Institutional $record) {
                                        $count = Institutional::where('type', 'interest_link')
                                            ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                            ->count();
                                        if ($count >= self::MAX_INTEREST_LINKS) {
                                            return 'Límite alcanzado: ' . self::MAX_INTEREST_LINKS . '/' . self::MAX_INTEREST_LINKS . ' links de interés. Solo puedes agregar socios/aliados.';
                                        }
                                        return 'Elige si es un link externo o un socio/aliado (' . $count . '/' . self::MAX_INTEREST_LINKS . ' links de interés)';
                                    })
                                    ->required()
                                    ->native(false)
                                    ->live()
                                    ->prefixIcon('heroicon-o-tag')
                                    ->placeholder('Selecciona el tipo de recurso')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Información')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                // CAMPOS PARA LINK DE INTERÉS
                                Forms\Components\TextInput::make('title')
                                    ->label('Título del Link')
                                    ->required(fn ($get) => $get('type') === 'interest_link')
                                    ->maxLength(100)
                                    ->placeholder('Ej: Portal Educativo Nacional')
                                    ->prefixIcon('heroicon-o-document-text')
                                    ->helperText('Nombre descriptivo del link de interés')
                                    ->visible(fn ($get) => $get('type') === 'interest_link')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->url()
                                    ->required(fn ($get) => $get('type') === 'interest_link')
                                    ->maxLength(255)
                                    ->placeholder('https://ejemplo.com')
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->helperText('🔗 Dirección web completa (debe incluir http:// o https://)')
                                    ->visible(fn ($get) => $get('type') === 'interest_link')
                                    ->columnSpanFull(),

                                // CAMPOS PARA SOCIO/ALIADO
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre del Socio/Aliado')
                                    ->required(fn ($get) => $get('type') === 'partner')
                                    ->maxLength(100)
                                    ->placeholder('Ej: Universidad Nacional')
                                    ->prefixIcon('heroicon-o-building-office-2')
                                    ->helperText('Nombre de la institución o empresa aliada')
                                    ->visible(fn ($get) => $get('type') === 'partner')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Multimedia')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Logo del Socio/Aliado')
                                    ->image()
                                    ->directory('partners/logos')
                                    ->disk('public')
                                    ->required(fn ($get) => $get('type') === 'partner')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->imageResizeMode('contain')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->helperText('📸 Logo o imagen del socio | Formatos: JPG, PNG | Máximo: 2MB')
                                    ->visible(fn ($get) => $get('type') === 'partner')
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('no_multimedia')
                                    ->label('')
                                    ->content('⚠️ Los links de interés no requieren multimedia.')
                                    ->visible(fn ($get) => $get('type') === 'interest_link'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Estado')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Recurso Activo')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Desactiva para ocultar este recurso temporalmente'),
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
                    ->color('success'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'interest_link' => '🔗 Link',
                        'partner' => '🤝 Socio',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'interest_link' => 'info',
                        'partner' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),


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
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'interest_link' => '🔗 Links de Interés',
                        'partner' => '🤝 Socios/Aliados',
                    ])
                    ->placeholder('Todos'),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
            ])
            ->actions([
                Tables\Actions\Action::make('visit')
                    ->label('')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->tooltip('Visitar enlace')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->type === 'interest_link' && $record->url),

                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles'),

                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar recurso'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar recurso institucional?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar recursos seleccionados?')
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
            'index' => Pages\ListInstitutionals::route('/'),
            'create' => Pages\CreateInstitutional::route('/create'),
            'edit' => Pages\EditInstitutional::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}