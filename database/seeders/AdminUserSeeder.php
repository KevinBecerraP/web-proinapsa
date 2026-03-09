<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------------------------------
        // CAMBIA ESTOS VALORES ANTES DE EJECUTAR
        // -------------------------------------------------------
        $adminEmail    = 'admin@proinapsa.edu.co';
        $adminPassword = 'Admin@12345';
        $adminName     = 'Administrador Proinapsa';
        $roleName      = 'SuperAdmin';
        // -------------------------------------------------------

        // 1. Crear o actualizar el rol SuperAdmin
        $role = Role::firstOrCreate(
            ['name' => $roleName, 'guard_name' => 'web']
        );

        // 2. Obtener todos los permisos existentes y asignarlos al rol
        $allPermissions = Permission::all();
        if ($allPermissions->isNotEmpty()) {
            $role->syncPermissions($allPermissions);
        }

        // 3. Crear o actualizar el usuario admin
        $user = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name'              => $adminName,
                'password'          => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        // 4. Asignar el rol SuperAdmin al usuario
        $user->syncRoles([$roleName]);

        $this->command->info('');
        $this->command->info('✅ Usuario admin creado/actualizado:');
        $this->command->info("   Email   : {$adminEmail}");
        $this->command->info("   Password: {$adminPassword}");
        $this->command->info("   Rol     : {$roleName}");
        $this->command->warn('⚠️  Recuerda cambiar la contraseña después de iniciar sesión.');
    }
}
