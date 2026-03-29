<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Noticias';

    protected static ?string $modelLabel = 'Noticia';

    protected static ?string $pluralModelLabel = 'Noticias';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Noticia')
                    ->description('Contenido principal de la noticia')
                    ->icon('heroicon-o-newspaper')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(150)
                            ->placeholder('Ej: PROINAPSA lanza nuevo programa de salud pública')
                            ->prefixIcon('heroicon-o-document-text')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El título es obligatorio.',
                                'max'      => 'El título no puede exceder los 150 caracteres.',
                            ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-o-link')
                            ->helperText('Se genera automáticamente a partir del título.')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Resumen')
                            ->required()
                            ->rows(3)
                            ->maxLength(300)
                            ->placeholder('Breve descripción que aparecerá en el listado de noticias...')
                            ->live(onBlur: true)
                            ->hint(function ($state) {
                                $length = strlen($state ?? '');
                                return $length . ' / 300 caracteres';
                            })
                            ->hintColor(function ($state) {
                                $length = strlen($state ?? '');
                                $remaining = 300 - $length;
                                if ($remaining < 30) return 'danger';
                                if ($remaining < 60) return 'warning';
                                return 'gray';
                            })
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El resumen es obligatorio.',
                                'max'      => 'El resumen no puede exceder los 300 caracteres.',
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen Principal')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675')
                            ->imagePreviewHeight('200')
                            ->directory('news/images')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('Se redimensionará automáticamente a 1200 × 675 px (16:9). Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'La imagen es obligatoria.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Contenido Completo')
                    ->description('Cuerpo de la noticia para la página de detalle')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenido')
                            ->required()
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen(strip_tags($state ?? '')) . ' / 6000 caracteres')
                            ->hintColor(fn ($state) => strlen(strip_tags($state ?? '')) > 5400 ? 'danger' : (strlen(strip_tags($state ?? '')) > 4800 ? 'warning' : 'gray'))
                            ->rules([
                                fn () => fn (string $attribute, $value, $fail) =>
                                    strlen(strip_tags($value ?? '')) > 6000
                                        ? $fail('El contenido no puede exceder los 6000 caracteres de texto visible.')
                                        : null,
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
                                'blockquote',
                            ])
                            ->placeholder('Escribe el contenido completo de la noticia...')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'El contenido de la noticia es obligatorio.',
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Configuración')
                    ->description('Orden y visibilidad en el sitio web')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->integer()
                                    ->default(fn () => (News::max('order') ?? 0) + 1)
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Posición de visualización. Se asigna automáticamente.')
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'required' => 'El orden es obligatorio.',
                                        'unique'   => 'Este número de orden ya está en uso. Elige otro.',
                                        'min'      => 'El orden debe ser mayor a 0.',
                                        'integer'  => 'El orden debe ser un número entero (1, 2, 3...).',
                                    ]),

                                Forms\Components\Toggle::make('active')
                                    ->label('Activo')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Las noticias inactivas no se mostrarán en el sitio web'),
                            ]),
                    ])->collapsible(),
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
                    ->weight('bold')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),

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
            ->defaultSort('created_at', 'desc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Estado')
                    ->placeholder('Todas')
                    ->trueLabel('Solo activas')
                    ->falseLabel('Solo inactivas'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar noticia'),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar noticia?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, eliminar')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar noticias seleccionadas?')
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
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->ordered();
    }
}
