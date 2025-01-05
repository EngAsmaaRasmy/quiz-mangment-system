<?php

namespace Modules\ACL\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ACLDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'view members',
            'create members',
            'edit members',
            'delete members',
            'view quizzes',
            'create quizzes',
            'edit quizzes',
            'delete quizzes',
        ];

        // Create and assign permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $memberRole = Role::firstOrCreate(['name' => 'member', 'guard_name' => 'web']);

        if ($adminRole) {
            $adminRole->syncPermissions($permissions); // Admin gets all permissions
        }

        if ($memberRole) {
            $memberRole->syncPermissions(['view quizzes']); // Member only gets permission to view quizzes
        }
    }
}
