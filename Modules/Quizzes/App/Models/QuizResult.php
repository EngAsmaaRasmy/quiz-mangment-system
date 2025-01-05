<?php

namespace Modules\Quizzes\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Members\App\Models\User;
use Modules\Quizzes\Database\factories\QuizResultFactory;

class QuizResult extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'quiz_id', 'score'];
    
    /**
     * Get the user who took the quiz.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quiz associated with this result.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
