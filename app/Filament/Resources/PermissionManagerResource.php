<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionManagerResource\Pages;
use App\Filament\Traits\HasRoleAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;

class PermissionManagerResource extends Resource
{
    use HasRoleAccess;

    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?string $navigationLabel = 'Permisos';
    protected static ?string $modelLabel = 'Permiso';
    protected static ?string $pluralModelLabel = 'Permisos';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool    { return static::canManageSystem(); }
    public static function canCreate(): bool     { return static::canManageSystem(); }
    public static function canEdit($record): bool   { return static::canManageSystem(); }
    public static function canDelete($record): bool { return static::canManageSystem(); }
    public static function shouldRegisterNavigation(): bool { return static::canManageSystem(); }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información del Permiso')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre del Permiso')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->prefixIcon('heroicon-o-tag')
                        ->placeholder('Ej: editBanner, deleteUser...')
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles_count')
                    ->label('Roles')
                    ->counts('roles')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->actions([
                Tables\Actions\EditAction::make()->label('')->tooltip('Editar'),
                Tables\Actions\DeleteAction::make()->label('')->tooltip('Eliminar')
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar permiso?')
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
            'index'  => Pages\ListPermissionManagers::route('/'),
            'create' => Pages\CreatePermissionManager::route('/create'),
            'edit'   => Pages\EditPermissionManager::route('/{record}/edit'),
        ];
    }
}
