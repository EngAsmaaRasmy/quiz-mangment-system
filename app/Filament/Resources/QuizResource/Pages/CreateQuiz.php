<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Quizzes\App\Models\Quiz;

class CreateQuiz extends CreateRecord
{
    protected static string $resource = QuizResource::class;

    protected function beforeSave(): void
    {
        $data = $this->form->getState();

        // Remove questions from the main data array
        $questionsData = $data['questions'];
        unset($data['questions']);

        $quiz = Quiz::create($data);

        foreach ($questionsData as $questionData) {
            $question = $quiz->questions()->create([
                'question_text' => $questionData['question'],
            ]);

            foreach ($questionData['options'] as $option) {
                $question->answers()->create([
                    'answer_text' => $option['option'],
                    'is_correct' => $option['is_correct'] ?? false,
                ]);
            }
        }
    }
}
