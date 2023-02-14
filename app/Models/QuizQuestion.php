<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question',
        'mandatory',
    ];

    protected $casts = [
        'mandatory' => 'boolean',
    ];

    public function answers() {
        return $this->hasMany(QuizAnswer::class);
    }
}
