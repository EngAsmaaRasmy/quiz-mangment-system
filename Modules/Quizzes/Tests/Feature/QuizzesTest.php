<?php

namespace Modules\Quizzes\Tests\Feature;

use Modules\Quizzes\App\Models\Answer;
use Modules\Quizzes\App\Models\Question;
use Modules\Quizzes\App\Models\Quiz;

uses(
    \Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
)->group('quizzes');

test('creates a quiz with questions and answers', function () {
    $quizzes = Quiz::factory()
        ->has(
            Question::factory()
                ->hasAnswers(4)
                ->count(5),
            'questions'
        )
        ->count(2)
        ->create();

    expect(Quiz::count())->toBe(2);

    $quizzes->each(function (Quiz $quiz) {
        expect($quiz->questions()->count())->toBe(5);

        $quiz->questions->each(function (Question $question) {
            expect($question->answers()->count())->toBe(4);
        });
    });
});

test('deletes a quiz and its related questions and answers', function () {
    $quiz = Quiz::factory()
        ->has(
            Question::factory()
                ->hasAnswers(4)
                ->count(5),
            'questions'
        )
        ->create();

    Quiz::truncate();
    Question::truncate();
    Answer::truncate();

    expect(Quiz::count())->toBe(0);
    expect(Question::count())->toBe(0);
    expect(Answer::count())->toBe(0);
});

