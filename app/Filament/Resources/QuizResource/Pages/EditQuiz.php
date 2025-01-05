<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuiz extends EditRecord
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        // Remove questions from the main data array
        $questionsData = $data['questions'];
        unset($data['questions']);

        // Get the current quiz
        $quiz = $this->record;

        // Delete existing questions and answers
        $quiz->questions()->delete();

        // Recreate questions and answers
        foreach ($questionsData as $questionData) {
            $question = $quiz->questions()->create([
                'question_text' => $questionData['question'],
            ]);

            foreach ($questionData['answers'] as $option) {
                $question->answers()->create([
                    'answer_text' => $option['option'],
                    'is_correct' => $option['is_correct'] ?? false,
                ]);
            }
        }
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure correct structure for questions and options
        foreach ($data['questions'] as &$question) {
            if (isset($question['answers'])) {
                $question['answers'] = array_values($question['answers']);
            }
        }

        return $data;
    }
}
