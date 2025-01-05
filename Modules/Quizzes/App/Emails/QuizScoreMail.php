<?php

namespace Modules\Quizzes\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Quizzes\App\Models\Quiz;

class QuizScoreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quiz;
    public $score;

    /**
     * @param Quiz $quiz
     * @param float $score
     */
    public function __construct(Quiz $quiz, float $score)
    {
        $this->quiz = $quiz;
        $this->score = $score;
    }

    /**
     * @return [type]
     */
    public function build()
    {
        return $this->subject('Your Quiz Score')
                    ->markdown('quizzes::emails.quiz-score');
    }
}
