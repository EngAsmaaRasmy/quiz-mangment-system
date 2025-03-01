<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            \Modules\ACL\Database\Seeders\ACLDatabaseSeeder::class
        ]);

    }
}
