<?php

namespace Modules\Quizzes\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quizzes\App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Quizzes\App\Models\Question;

class QuizzesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::factory()
        ->has(Question::factory()->hasAnswers(4)->count(5), 'questions')
        ->count(2)
        ->create();
    }
}
