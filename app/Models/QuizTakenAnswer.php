<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTakenAnswer extends Model
{
    use HasFactory;

    protected $table = 'quiz_taken_answers';

    protected $fillable = [
        'quiz_taken_id',
        'quiz_question_id',
        'quiz_answer_id',
    ];

    public function quizTaken() {
        return $this->belongsTo(QuizTaken::class);
    }

    public function question() {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }

    public function answer() {
        return $this->belongsTo(QuizAnswer::class, 'quiz_answer_id');
    }
}
