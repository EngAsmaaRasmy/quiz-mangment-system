<?php

namespace Modules\Quizzes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Quizzes\App\Models\Question;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Quizzes\App\Models\Quiz::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }

    /**
     * Define a relationship with questions.
     *
     * @param int $count Number of questions per quiz
     */
    public function hasQuestions(int $count = 5): static
    {
        return $this->has(
            Question::factory()->count($count),
            'questions'
        );
    }
}

