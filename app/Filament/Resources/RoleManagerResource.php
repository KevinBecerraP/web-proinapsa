<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleManagerResource\Pages;
use App\Filament\Traits\HasRoleAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RoleManagerResource extends Resource
{
    use HasRoleAccess;

    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $modelLabel = 'Rol';
    protected static ?string $pluralModelLabel = 'Roles';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool    { return static::canManageSystem(); }
    public static function canCreate(): bool     { return static::canManageSystem(); }
    public static function canEdit($record): bool   { return static::canManageSystem(); }
    public static function canDelete($record): bool { return static::canManageSystem(); }
    public static function shouldRegisterNavigation(): bool { return static::canManageSystem(); }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información del Rol')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre del Rol')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->prefixIcon('heroicon-o-tag')
                        ->placeholder('Ej: Editor, Moderador...')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Permisos')
                ->icon('heroicon-o-lock-open')
                ->description('Selecciona los permisos que tendrá este rol')
                ->schema([
                    Forms\Components\CheckboxList::make('permissions')
                        ->label('')
                        ->relationship('permissions', 'name')
                        ->searchable()
                        ->bulkToggleable()
                        ->columns(3)
                        ->gridDirection('row')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Permisos')
                    ->counts('permissions')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('users_count')
                    ->label('Usuarios')
                    ->counts('users')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->tooltip('Editar'),
                Tables\Actions\DeleteAction::make()->label('')->tooltip('Eliminar')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar rol?')
                    ->modalDescription('Esta acción no se puede deshacer.'),
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
            'index'  => Pages\ListRoleManagers::route('/'),
            'create' => Pages\CreateRoleManager::route('/create'),
            'edit'   => Pages\EditRoleManager::route('/{record}/edit'),
        ];
    }
}
