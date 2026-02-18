<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthPromotionItemResource\Pages;
use App\Models\HealthPromotionItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class HealthPromotionItemResource extends Resource
{
    protected static ?string $model = HealthPromotionItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Ítems de Salud';

    protected static ?string $modelLabel = 'Ítem de Promoción de Salud';

    protected static ?string $pluralModelLabel = 'Ítems de Promoción de Salud';

    protected static ?string $navigationGroup = 'Proyección Social';

    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Ítem')
                    ->description('Ítems tipo viñeta que pertenecen a cada categoría de promoción de salud')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'display_name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Selecciona la categoría a la que pertenece este ítem')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('short_description')
                            ->label('Descripción Corta')
                            ->required()
                            ->maxLength(150)
                            ->rows(3)
                            ->helperText('Máximo 150 caracteres')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('active')
                            ->label('Activo')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
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

                Tables\Columns\TextColumn::make('category.category_label')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('short_description')
                    ->label('Descripción')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'display_name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Activo')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
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
            ])
            ->groups([
                Tables\Grouping\Group::make('category.display_name')
                    ->label('Categoría')
                    ->collapsible(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHealthPromotionItems::route('/'),
            'create' => Pages\CreateHealthPromotionItem::route('/create'),
            'edit' => Pages\EditHealthPromotionItem::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('category')->ordered();
    }
}