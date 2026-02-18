<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicationResource\Pages;
use App\Models\Publication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Publicaciones';

    protected static ?string $modelLabel = 'Publicación';

    protected static ?string $pluralModelLabel = 'Publicaciones';

    protected static ?string $navigationGroup = 'Investigación';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Publicación')
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->label('Área')
                            ->relationship('area', 'name')
                            ->default(fn () => \App\Models\Area::where('slug', 'investigacion')->first()?->id)
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtítulo')
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('short_description')
                            ->label('Descripción Corta')
                            ->required()
                            ->maxLength(300)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->image()
                            ->directory('publications/images')
                            ->required()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->imageResizeMode('cover')
                            ->helperText('Máximo 2MB. Formatos: JPG, PNG')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('external_link')
                            ->label('Link Externo')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->helperText('URL de la publicación externa')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'active' => 'Activo',
                                'inactive' => 'Inactivo',
                            ])
                            ->required()
                            ->default('active'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Líneas de Investigación')
                    ->schema([
                        Forms\Components\TextInput::make('research_line_1')
                            ->label('Línea de Investigación 1')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('research_line_2')
                            ->label('Línea de Investigación 2')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('research_line_3')
                            ->label('Línea de Investigación 3 (Opcional)')
                            ->maxLength(100),
                    ])
                    ->columns(3),
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

                Tables\Columns\ImageColumn::make('image')
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

                Tables\Columns\TextColumn::make('research_line_1')
                    ->label('Línea 1')
                    ->limit(20)
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
                        'inactive' => 'Inactivo',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('view_link')
                    ->label('Ver Publicación')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => $record->external_link)
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListPublications::route('/'),
            'create' => Pages\CreatePublication::route('/create'),
            'edit' => Pages\EditPublication::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}