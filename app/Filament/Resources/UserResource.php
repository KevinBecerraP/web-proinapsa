<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Traits\HasRoleAccess;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    use HasRoleAccess;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool    { return static::canManageUsers(); }
    public static function canCreate(): bool     { return static::canManageUsers(); }
    public static function canEdit($record): bool   { return static::canManageUsers(); }
    public static function canDelete($record): bool { return static::canManageUsers(); }
    public static function shouldRegisterNavigation(): bool { return static::canManageUsers(); }

    public static function getModelLabel(): string
    {
        return 'Usuario';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Usuarios';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->description('Datos básicos del usuario')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Juan Pérez')
                                    ->prefixIcon('heroicon-o-user')
                                    ->autocomplete('name'),

                                Forms\Components\TextInput::make('email')
                                    ->label('Correo Electrónico')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('ejemplo@dominio.com')
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->unique(ignoreRecord: true)
                                    ->autocomplete('email'),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Seguridad')
                    ->description('Contraseña y autenticación')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('password')
                                    ->label('Contraseña')
                                    ->password()
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->minLength(8)
                                    ->maxLength(255)
                                    ->placeholder('Mínimo 8 caracteres')
                                    ->prefixIcon('heroicon-o-key')
                                    ->revealable()
                                    ->dehydrated(fn($state) => filled($state))
                                    ->autocomplete('new-password')
                                    ->visibleOn('create'),

                                Forms\Components\TextInput::make('password_confirmation')
                                    ->label('Confirmar Contraseña')
                                    ->password()
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->maxLength(255)
                                    ->placeholder('Repite la contraseña')
                                    ->prefixIcon('heroicon-o-key')
                                    ->revealable()
                                    ->same('password')
                                    ->dehydrated(false)
                                    ->autocomplete('new-password')
                                    ->visibleOn('create'),
                            ]),

                        // Cambio de contraseña en edición
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('new_password')
                                    ->label('Nueva Contraseña')
                                    ->password()
                                    ->revealable()
                                    ->minLength(8)
                                    ->maxLength(255)
                                    ->placeholder('Déjalo vacío para no cambiarla')
                                    ->prefixIcon('heroicon-o-key')
                                    ->autocomplete('new-password')
                                    ->dehydrated(false)
                                    ->rule(function ($get, $record) {
                                        return function (string $attribute, $value, \Closure $fail) use ($record) {
                                            if (filled($value) && Hash::check($value, $record->password)) {
                                                $fail('La nueva contraseña no puede ser igual a la actual.');
                                            }
                                        };
                                    })
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        if (blank($state)) {
                                            $set('new_password_confirmation', null);
                                        }
                                    })
                                    ->live(onBlur: true),

                                Forms\Components\TextInput::make('new_password_confirmation')
                                    ->label('Confirmar Nueva Contraseña')
                                    ->password()
                                    ->revealable()
                                    ->maxLength(255)
                                    ->placeholder('Repite la nueva contraseña')
                                    ->prefixIcon('heroicon-o-key')
                                    ->autocomplete('new-password')
                                    ->dehydrated(false)
                                    ->same('new_password'),
                            ])
                            ->visibleOn('edit'),
                    ])->collapsible(),

                Forms\Components\Section::make('Roles y Permisos')
                    ->description('Asigna los roles correspondientes')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->label('Roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->placeholder('Selecciona uno o más roles')
                            ->prefixIcon('heroicon-o-user-group')
                            ->helperText('Puedes seleccionar múltiples roles')
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y')
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
                    ->tooltip('Ver detalles'),

                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar usuario'),

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

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('email', '!=', \App\Models\User::ROOT_EMAIL);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}