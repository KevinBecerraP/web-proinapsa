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
                        Forms\Components\Hidden::make('area_id')
                            ->default(fn () => \App\Models\Area::where('slug', 'investigacion')->first()?->id),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El título de la publicación es obligatorio.',
                                'max'      => 'El título no puede exceder los 50 caracteres.',
                                'unique'   => 'Ya existe una publicación con este título.',
                            ]),

                        Forms\Components\Textarea::make('short_description')
                            ->label('Descripción Corta')
                            ->required()
                            ->maxLength(150)
                            ->rows(3)
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 150 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 130 ? 'danger' : (strlen($state ?? '') > 110 ? 'warning' : 'gray'))
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La descripción corta es obligatoria.',
                                'max'      => 'La descripción no puede exceder los 150 caracteres.',
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('390')
                            ->imageResizeTargetHeight('200')
                            ->directory('publications/images')
                                    ->disk('public')
                            ->required()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Se redimensionará automáticamente a 390 × 200 px. Formatos: JPG, PNG. Máx 2MB')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La imagen de la publicación es obligatoria.',
                            ]),

                        Forms\Components\TextInput::make('external_link')
                            ->label('Link Externo')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->helperText('URL de la publicación externa')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El link externo es obligatorio.',
                                'max'      => 'El link no puede exceder los 255 caracteres.',
                            ]),

                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'active' => 'Activo',
                                'inactive' => 'Inactivo',
                            ])
                            ->required()
                            ->default('active')
                            ->validationMessages([
                                'required' => 'El estado es obligatorio.',
                            ]),
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
                    ->color('success'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('status_label')
                    ->label('Estado')
                    ->badge()
                    ->color(fn ($record) => $record->status_badge_color),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
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
                    ->label('')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->tooltip('Ver Publicación')
                    ->url(fn ($record) => $record->external_link)
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label('')
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