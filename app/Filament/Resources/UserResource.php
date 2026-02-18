<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?int $navigationSort = 1;

    private static function userCanList(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('listUsers') || $user->hasRole('SuperAdmin');
    }

    private static function userCanCreate(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('createUser') || $user->hasRole('SuperAdmin');
    }

    private static function userCanEdit(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('editUser') || $user->hasRole('SuperAdmin');
    }

    private static function userCanDelete(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        return $user->can('deleteUser') || $user->hasRole('SuperAdmin');
    }

    public static function canViewAny(): bool
    {
        return static::userCanList();
    }

    public static function canCreate(): bool
    {
        return static::userCanCreate();
    }

    public static function canEdit($record): bool
    {
        return static::userCanEdit();
    }

    public static function canDelete($record): bool
    {
        return static::userCanDelete();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

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
                                    ->hiddenOn('edit')
                                    ->minLength(8)
                                    ->maxLength(255)
                                    ->placeholder('Mínimo 8 caracteres')
                                    ->prefixIcon('heroicon-o-key')
                                    ->revealable()
                                    ->dehydrated(fn($state) => filled($state))
                                    ->autocomplete('new-password'),

                                Forms\Components\TextInput::make('password_confirmation')
                                    ->label('Confirmar Contraseña')
                                    ->password()
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->hiddenOn('edit')
                                    ->maxLength(255)
                                    ->placeholder('Repite la contraseña')
                                    ->prefixIcon('heroicon-o-key')
                                    ->revealable()
                                    ->same('password')
                                    ->dehydrated(false)
                                    ->autocomplete('new-password'),
                            ]),
                    ])->collapsible()->hiddenOn('edit'),

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
                    ->tooltip('Editar usuario')
                    ->visible(fn() => static::userCanEdit()),

                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Eliminar permanentemente')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar permanentemente?')
                    ->modalDescription('Esta acción NO se puede deshacer.')
                    ->visible(fn() => static::userCanDelete()),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}