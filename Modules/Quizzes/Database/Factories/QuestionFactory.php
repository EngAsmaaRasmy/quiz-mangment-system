<?php

namespace Modules\Quizzes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Quizzes\App\Models\Answer;
use Modules\Quizzes\App\Models\Quiz;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Quizzes\App\Models\Question::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'question_text' => $this->faker->sentence(),
        ];
    }

     /**
     * Define a relationship with answers.
     *
     * @param int $count Number of answers per question
     */
    public function hasAnswers(int $count = 4): static
    {
        return $this->has(
            Answer::factory()->count($count),
            'answers'
        );
    }
}

