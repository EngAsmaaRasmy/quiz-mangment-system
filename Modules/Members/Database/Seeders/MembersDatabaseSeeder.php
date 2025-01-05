<?php

namespace Modules\Members\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Members\App\Models\User;
use Spatie\Permission\Models\Role;

class MembersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'test@test.com',
            'password' => bcrypt(123456),
            'type' => 'admin',
            'email_verified_at' => now(),
        ]);

        $user->assignRole($adminRole);

        User::factory()->count(5)->create();
    }
}
