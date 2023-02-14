<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $table = 'quiz_answers';

    protected $fillable = [
        'quiz_question_id',
        'answer',
        'correct',
    ];

    protected $casts = [
        'correct' => 'boolean',
    ];
}
