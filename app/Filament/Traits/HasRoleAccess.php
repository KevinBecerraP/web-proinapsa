<?php

namespace App\Filament\Traits;

use App\Models\User;

trait HasRoleAccess
{
    protected static function isRoot(): bool
    {
        return auth()->user()?->email === User::ROOT_EMAIL;
    }

    protected static function isSuperAdmin(): bool
    {
        return auth()->user()?->hasRole('Super Admin');
    }

    protected static function isCoordinator(): bool
    {
        return auth()->user()?->hasRole('Coordinador-Area');
    }

    // Acceso al contenido: Root, Super Admin o Coordinador
    protected static function canAccessContent(): bool
    {
        return static::isRoot() || static::isSuperAdmin() || static::isCoordinator();
    }

    // Acceso a usuarios: solo Root o Super Admin
    protected static function canManageUsers(): bool
    {
        return static::isRoot() || static::isSuperAdmin();
    }

    // Acceso al sistema (roles y permisos): solo Root
    protected static function canManageSystem(): bool
    {
        return static::isRoot();
    }
}
