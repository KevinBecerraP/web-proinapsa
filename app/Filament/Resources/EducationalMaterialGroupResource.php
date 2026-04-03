<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalMaterialGroupResource\Pages;
use App\Models\EducationalMaterialGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use App\Filament\Traits\HasRoleAccess;

class EducationalMaterialGroupResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = EducationalMaterialGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Grupos de Materiales';

    protected static ?string $modelLabel = 'Grupo de Materiales';

    protected static ?string $pluralModelLabel = 'Grupos de Materiales';

    protected static ?string $navigationGroup = 'Educación y Comunicación';

    protected static ?int $navigationSort = 11;

    protected static bool $shouldRegisterNavigation = true;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sección')
                    ->description('Categoría interna y nombre que se mostrará al cargar materiales educativos')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'early_childhood' => 'Primera Infancia',
                                'childhood'       => 'Niñez, Adolescencia y Juventud',
                                'women'           => 'Mujer',
                                'workers'         => 'Trabajadores',
                            ])
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('display_name')
                            ->label('Nombre a Mostrar')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Ej: Primera Infancia')
                            ->helperText('Este nombre aparecerá en el selector "Sección" al cargar un material educativo.')
                            ->columnSpanFull(),
                    ])->columns(2)->collapsible(),

                Forms\Components\Section::make('Estado y Orden')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Si está inactivo, no aparecerá como opción al cargar materiales'),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(999)
                            ->integer()
                            ->default(fn () => (EducationalMaterialGroup::max('order') ?? 0) + 1)
                            ->prefixIcon('heroicon-o-arrows-up-down')
                            ->helperText('Posición en el selector (1–999).')
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El orden es obligatorio.',
                                'unique'   => 'Este número de orden ya está en uso.',
                                'min'      => 'El orden debe ser mayor a 0.',
                                'max'      => 'El orden no puede ser mayor a 999.',
                                'integer'  => 'El orden debe ser un número entero.',
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
                    ->color('success'),

                Tables\Columns\TextColumn::make('category_label')
                    ->label('Categoría')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('display_name')
                    ->label('Nombre a Mostrar')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar grupo'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationalMaterialGroups::route('/'),
            'edit'  => Pages\EditEducationalMaterialGroup::route('/{record}/edit'),
        ];
    }
}
