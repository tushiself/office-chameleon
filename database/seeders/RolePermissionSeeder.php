<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define all permissions
        $permissions = [
            'create_role',
            'edit_role',
            'view_role',
            'delete_role',
            'create_permission',
            'edit_permission',
            'view_permission',
            'delete_permission',
            'create_staff',
            'edit_staff',
            'view_staff',
            'delete_staff',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Map roles to permissions
        $rolesWithPermissions = [
            'Admin' => $permissions, // Superadmin has all permissions
            'Manager' => $permissions,
            'Staff' => [
                'view_staff',
            ],
        ];

        // Assign permissions to roles
        foreach ($rolesWithPermissions as $roleName => $rolePermissions) {
            $role = Role::firstWhere('name', $roleName);
            if ($role) {
                $role->syncPermissions($rolePermissions);
            }
        }
    }
}
