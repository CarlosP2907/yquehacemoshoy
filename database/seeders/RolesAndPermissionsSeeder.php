<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos para usuarios
        $userPermissions = [
            'view posts',
            'create comments',
            'edit profile',
            'view places',
            'rate places',
        ];

        // Crear permisos para empresas
        $companyPermissions = [
            'create posts',
            'edit own posts',
            'delete own posts',
            'view analytics',
            'manage profile',
        ];

        // Crear permisos para admin
        $adminPermissions = [
            'manage users',
            'manage companies',
            'manage places',
            'manage posts',
            'manage plans',
            'view all analytics',
            'verify companies',
        ];

        // Crear permisos para usuarios premium
        $premiumPermissions = [
            'priority support',
            'advanced filters',
            'export data',
        ];

        // Crear todos los permisos
        $allPermissions = array_merge($userPermissions, $companyPermissions, $adminPermissions, $premiumPermissions);
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        
        // Rol: Usuario Normal
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($userPermissions);

        // Rol: Usuario Premium
        $premiumUserRole = Role::create(['name' => 'premium_user']);
        $premiumUserRole->givePermissionTo(array_merge($userPermissions, $premiumPermissions));

        // Rol: Empresa
        $companyRole = Role::create(['name' => 'company']);
        $companyRole->givePermissionTo(array_merge($userPermissions, $companyPermissions));

        // Rol: Administrador
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($allPermissions);

        $this->command->info('Roles and permissions created successfully!');
    }
}
