<?php

namespace Modules\Quizzes\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Quizzes\Database\factories\AnswerFactory;

class Answer extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['question_id', 'answer_text', 'is_correct'];
    
    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return AnswerFactory
     */
    protected static function newFactory(): AnswerFactory
    {
        return AnswerFactory::new();
    }
}
