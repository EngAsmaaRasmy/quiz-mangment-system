<?php

namespace Modules\Quizzes\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Members\App\Models\User;
use Modules\Quizzes\Database\factories\UserAnswerFactory;

class UserAnswer extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $primaryKey = null;
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'question_id', 'quiz_id', 'answer_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
