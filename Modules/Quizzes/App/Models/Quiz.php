<?php

namespace Modules\Quizzes\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Members\App\Models\User;
use Modules\Quizzes\Database\factories\QuizFactory;

class Quiz extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'description'];
    
    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_answers')
                    ->withPivot('question_id', 'answer_id', 'created_at', 'updated_at');
    }

    /**
     * @return QuizFactory
     */
    protected static function newFactory(): QuizFactory
    {
        return QuizFactory::new();
    }
}
