<?php

namespace Modules\Quizzes\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Quizzes\App\Emails\QuizScoreMail;
use Modules\Quizzes\App\Models\Quiz;

class SendQuizScoreEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quiz;
    public $score;
    public $email;

    /**
     * Create a new job instance.
     */
    public function __construct(Quiz $quiz, float $score, string $email)
    {
        $this->quiz = $quiz;
        $this->score = $score;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new QuizScoreMail($this->quiz, $this->score));
    }
}
