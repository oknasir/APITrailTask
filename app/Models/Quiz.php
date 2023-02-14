<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = [
        'title',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function questions() {
        return $this->hasMany(QuizQuestion::class);
    }
}
