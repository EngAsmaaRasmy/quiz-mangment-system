<?php

namespace Modules\Quizzes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Quizzes\App\Models\Question;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Quizzes\App\Models\Answer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'answer_text' => $this->faker->word(),
            'is_correct' => $this->faker->boolean(20),
        ];
    }
}

