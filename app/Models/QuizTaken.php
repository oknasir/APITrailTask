<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTaken extends Model
{
    use HasFactory;

    protected $table = 'quiz_taken';

    protected $fillable = [
        'quiz_id',
        'rating',
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function takenAnswers() {
        return $this->hasMany(QuizTakenAnswer::class);
    }
}
