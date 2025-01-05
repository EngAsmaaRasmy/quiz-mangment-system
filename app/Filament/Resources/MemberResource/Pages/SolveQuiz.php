<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\Page;
use Illuminate\Http\Request;
use Modules\Quizzes\App\Jobs\SendQuizScoreEmailJob;
use Modules\Quizzes\App\Models\Quiz;
use Modules\Quizzes\App\Models\QuizResult;
use Modules\Quizzes\App\Models\UserAnswer;

class SolveQuiz extends Page
{
    protected static string $resource = MemberResource::class;

    public Quiz $quiz;
    public array $answers = [];

    protected static string $view = 'filament.resources.member-resource.pages.solve-quiz';

    public function mount($quizId)
    {
        $this->quiz = Quiz::with('questions.answers')->findOrFail($quizId);
    }

    public function submit(Request $request, $id)
    {
        $this->quiz = Quiz::with('questions.answers')->findOrFail($id);
    
        $totalQuestions = $this->quiz->questions->count();
        $correctAnswersCount = 0;
    
        $existingSubmission = QuizResult::where('user_id', $request->user()->id)
                                        ->where('quiz_id', $id)
                                        ->exists();
    
        if ($existingSubmission) {
            return redirect()->route('filament.admin.resources.members.index')
                             ->with('error', 'You have already submitted this quiz.');
        }
    
        foreach ($this->quiz->questions as $question) {
            $submittedAnswerId = $request->input("answers.{$question->id}");

            if ($submittedAnswerId) {
                $answers[$this->quiz->id] = [
                    'question_id' => $question->id,
                    'answer_id' => $submittedAnswerId,
                ];
            }
    
            if (is_null($submittedAnswerId)) {
                continue;
            }
    
            $correctAnswers = $question->answers->where('is_correct', true)->pluck('id')->toArray();
    
            if (in_array($submittedAnswerId, $correctAnswers)) {
                $correctAnswersCount++;
            }

            $request->user()->quizzes()->sync($answers);
        }
    
        $finalScore = ($correctAnswersCount / $totalQuestions) * 100;
    
        QuizResult::create([
            'user_id' => $request->user()->id,
            'quiz_id' => $this->quiz->id,
            'score' => $finalScore,
        ]);
    
        SendQuizScoreEmailJob::dispatch($this->quiz, $finalScore, $request->user()->email);
    
        return redirect()->route('filament.admin.resources.members.index')
                         ->with('success', 'Quiz submitted successfully! Your score has been emailed to you.');
    }
    
}
