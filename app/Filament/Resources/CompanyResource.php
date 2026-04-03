<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Traits\HasRoleAccess;

class CompanyResource extends Resource
{
    use HasRoleAccess;

    public static function canViewAny(): bool    { return static::canAccessContent(); }
    public static function canCreate(): bool     { return static::canAccessContent(); }
    public static function canEdit($record): bool   { return static::canAccessContent(); }
    public static function canDelete($record): bool { return static::canAccessContent(); }
    public static function shouldRegisterNavigation(): bool { return static::canAccessContent(); }
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Empresas';

    protected static ?string $modelLabel = 'Empresa';

    protected static ?string $pluralModelLabel = 'Empresas';

    // Métodos helper para verificar permisos





    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información General')
                    ->description('Datos básicos de la empresa')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('business_name')
                                    ->label('Razón Social')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Empresa S.A.S.')
                                    ->prefixIcon('heroicon-o-building-office-2')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('slogan')
                                    ->label('Eslogan')
                                    ->maxLength(255)
                                    ->placeholder('Ej: Tu mejor aliado comercial')
                                    ->prefixIcon('heroicon-o-chat-bubble-left-right')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción')
                                    ->required()
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->placeholder('Describe tu empresa...')
                                    ->live(onBlur: true)
                                    ->hint(fn ($state) => strlen($state ?? '') . ' / 1000 caracteres')
                                    ->hintColor(fn ($state) => strlen($state ?? '') > 900 ? 'danger' : (strlen($state ?? '') > 800 ? 'warning' : 'gray'))
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('address')
                                    ->label('Dirección')
                                    ->required()
                                    ->rows(2)
                                    ->maxLength(300)
                                    ->placeholder('Calle, número, ciudad, país')
                                    ->live(onBlur: true)
                                    ->hint(fn ($state) => strlen($state ?? '') . ' / 300 caracteres')
                                    ->hintColor(fn ($state) => strlen($state ?? '') > 250 ? 'danger' : (strlen($state ?? '') > 200 ? 'warning' : 'gray'))
                                    ->columnSpanFull(),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Contacto - Teléfonos')
                    ->description('Números de contacto (mínimo 1 requerido)')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('phone_1')
                                    ->label('Teléfono Principal')
                                    ->required()
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+57 300 123 4567')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('phone_2')
                                    ->label('Teléfono 2')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+57 300 123 4567')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('phone_3')
                                    ->label('Teléfono 3')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+57 300 123 4567')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('phone_4')
                                    ->label('Teléfono 4')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+57 300 123 4567')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('phone_5')
                                    ->label('Teléfono 5')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+57 300 123 4567')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->columnSpan(1),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Contacto - Correos Electrónicos')
                    ->description('Correos de contacto (mínimo 1 requerido)')
                    ->icon('heroicon-o-envelope')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('email_1')
                                    ->label('Email Principal')
                                    ->required()
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('contacto@empresa.com')
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('email_2')
                                    ->label('Email 2')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('ventas@empresa.com')
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('email_3')
                                    ->label('Email 3')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('soporte@empresa.com')
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->columnSpan(1),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Redes Sociales')
                    ->description('Enlaces a redes sociales (opcional)')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('facebook_link')
                                    ->label('Facebook')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://facebook.com/empresa')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('instagram_link')
                                    ->label('Instagram')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://instagram.com/empresa')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('youtube_link')
                                    ->label('YouTube')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://youtube.com/@empresa')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('x_link')
                                    ->label('X (Twitter)')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://x.com/empresa')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('whatsapp_link')
                                    ->label('WhatsApp')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://wa.me/573001234567')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('threads_link')
                                    ->label('Threads')
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://threads.net/@empresa')
                                    ->prefixIcon('heroicon-o-link')
                                    ->columnSpan(1),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Multimedia')
                    ->description('Logos, video y documentos')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo de la Empresa')
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('725')
                                    ->imageResizeTargetHeight('121')
                                    ->imagePreviewHeight('150')
                                    ->panelLayout('integrated')
                                    ->directory('company/logos')
                                    ->disk('public')
                                    ->maxSize(2048)
                                    ->downloadable()

                                    ->helperText('📐 Dimensión final: 725 × 121 px - La imagen se redimensionará automáticamente sin recortar. Logo principal del sitio web. Formatos: JPG, PNG. Máximo: 2MB')
                                    ->columnSpan(1),

                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('force')
                                    ->imageResizeTargetWidth('132')
                                    ->imageResizeTargetHeight('128')
                                    ->imagePreviewHeight('150')
                                    ->panelLayout('integrated')
                                    ->directory('company/favicons')
                                    ->disk('public')
                                    ->maxSize(512)
                                    ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon'])
                                    ->downloadable()

                                    ->helperText('📐 Dimensión final: 132 × 128 px - La imagen se redimensionará automáticamente sin recortar. Ícono de la pestaña del navegador. Formato: PNG o ICO. Máximo: 512KB')
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\TextInput::make('video_link')
                            ->label('Link de Video')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://youtube.com/watch?v=...')
                            ->prefixIcon('heroicon-o-video-camera')
                            ->helperText('Link de YouTube, Vimeo, etc.')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('privacy_policy_pdf')
                            ->label('Política de Protección de Datos (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('company/policies')
                                    ->disk('public')
                            ->maxSize(5120)
                            ->downloadable()

                            ->previewable()
                            ->helperText('Formato: PDF. Tamaño máximo: 5MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Misión')
                    ->description('Información sobre la misión de la empresa')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        Forms\Components\TextInput::make('mission_title')
                            ->label('Título de la Misión')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Nuestra Misión')
                            ->prefixIcon('heroicon-o-document-text')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('mission_description')
                            ->label('Descripción de la Misión')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Describe la misión de tu empresa...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 1000 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 900 ? 'danger' : (strlen($state ?? '') > 800 ? 'warning' : 'gray'))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('mission_image')
                            ->label('Imagen de la Misión')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('635')
                            ->imageResizeTargetHeight('492')
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->directory('company/mission')
                                    ->disk('public')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('📐 Dimensión final: 635 × 492 px - La imagen se redimensionará automáticamente sin recortar. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Visión')
                    ->description('Información sobre la visión de la empresa')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Forms\Components\TextInput::make('vision_title')
                            ->label('Título de la Visión')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Nuestra Visión')
                            ->prefixIcon('heroicon-o-document-text')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('vision_description')
                            ->label('Descripción de la Visión')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Describe la visión de tu empresa...')
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 1000 caracteres')
                            ->hintColor(fn ($state) => strlen($state ?? '') > 900 ? 'danger' : (strlen($state ?? '') > 800 ? 'warning' : 'gray'))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('vision_image')
                            ->label('Imagen de la Visión')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('960')
                            ->imageResizeTargetHeight('523')
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->directory('company/vision')
                                    ->disk('public')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('📐 Dimensión final: 960 × 523 px - La imagen se redimensionará automáticamente sin recortar. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Trayectoria')
                    ->description('Línea de tiempo e historia de la institución')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Forms\Components\TextInput::make('trajectory_title')
                            ->label('Título de la Trayectoria')
                            ->maxLength(255)
                            ->placeholder('Ej: Nuestra Historia')
                            ->prefixIcon('heroicon-o-document-text')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('trajectory_description')
                            ->label('Descripción de la Trayectoria')
                            ->rows(4)
                            ->maxLength(500)
                            ->placeholder('Describe la trayectoria e historia de la institución...')
                            ->live(onBlur: true)
                            ->hint(function ($state) {
                                $length = strlen($state ?? '');
                                return $length . ' / 500 caracteres';
                            })
                            ->hintColor(function ($state) {
                                $length = strlen($state ?? '');
                                $remaining = 500 - $length;
                                if ($remaining < 50) return 'danger';
                                if ($remaining < 100) return 'warning';
                                return 'gray';
                            })
                            ->validationMessages([
                                'max' => 'La descripción no puede exceder los 500 caracteres.',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('trajectory_image')
                            ->label('Imagen de Trayectoria')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('600')
                            ->directory('company/trajectory')
                                    ->disk('public')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('Se redimensionará automáticamente a 800 × 600 px. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Metodología')
                    ->description('Descripción del enfoque y metodología de trabajo')
                    ->icon('heroicon-o-beaker')
                    ->schema([
                        Forms\Components\TextInput::make('methodology_title')
                            ->label('Título de la Metodología')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Nuestra Metodología')
                            ->prefixIcon('heroicon-o-document-text')
                            ->validationMessages([
                                'required' => 'El título de la metodología es obligatorio.',
                                'max'      => 'El título no puede exceder los 255 caracteres.',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('methodology_description')
                            ->label('Descripción de la Metodología')
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
                            ->live(onBlur: true)
                            ->hint(function ($state) {
                                $length = strlen(strip_tags($state ?? ''));
                                return $length . ' / 800 caracteres';
                            })
                            ->hintColor(function ($state) {
                                $length = strlen(strip_tags($state ?? ''));
                                $remaining = 800 - $length;
                                if ($remaining < 80) return 'danger';
                                if ($remaining < 160) return 'warning';
                                return 'gray';
                            })
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, $fail) {
                                        if (strlen(strip_tags($value ?? '')) > 800) {
                                            $fail('La descripción no puede exceder los 800 caracteres de texto visible.');
                                        }
                                    };
                                },
                            ])
                            ->validationMessages([
                                'required' => 'La descripción de la metodología es obligatoria.',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('methodology_image')
                            ->label('Imagen de la Metodología')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('800')
                            ->directory('company/methodology')
                                    ->disk('public')
                            ->maxSize(2048)
                            ->downloadable()

                            ->helperText('Se redimensionará automáticamente a 800 × 800 px. Formatos: JPG, PNG. Máximo: 2MB')
                            ->validationMessages([
                                'required' => 'La imagen de la metodología es obligatoria.',
                            ])
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Valores')
                    ->description('Imagen general de la sección de valores')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Forms\Components\FileUpload::make('values_image')
                            ->label('Imagen Valores')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('635')
                            ->imageResizeTargetHeight('627')
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->directory('company/values')
                            ->disk('public')
                            ->maxSize(2048)
                            ->downloadable()
                            ->helperText('📐 Dimensión final: 635 × 627 px. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Geolocalización')
                    ->description('Coordenadas de ubicación de la empresa')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitud')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Ej: 7.119349')
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->helperText('Coordenada de latitud (decimal)')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitud')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Ej: -73.122742')
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->helperText('Coordenada de longitud (decimal)')
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Placeholder::make('map_helper')
                            ->label('Ayuda')
                            ->content('Puedes obtener las coordenadas desde Google Maps: clic derecho en el mapa → copiar coordenadas')
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business_name')
                    ->label('Razón Social')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_1')
                    ->label('Email Principal')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('phone_1')
                    ->label('Teléfono Principal')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Ver detalles')
                    ->visible(fn() => static::userCanList()),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar información de la empresa')
                    ->visible(fn() => static::userCanEdit()),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar permanentemente?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->visible(fn() => static::userCanDelete())
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => static::userCanDelete())
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}