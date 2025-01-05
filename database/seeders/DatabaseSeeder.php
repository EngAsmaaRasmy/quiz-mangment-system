<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            \Modules\ACL\Database\Seeders\ACLDatabaseSeeder::class,
            \Modules\Members\Database\Seeders\MembersDatabaseSeeder::class,
            \Modules\Quizzes\Database\Seeders\QuizzesDatabaseSeeder::class,
        ]);

    }
}
