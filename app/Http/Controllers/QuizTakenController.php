<?php

namespace App\Http\Controllers;

use App\Models\QuizTaken;
use Illuminate\Http\Request;

class QuizTakenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|integer',
            'rating' => 'required|numeric|min:1|max:5',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer',
            'answers.*.answer_id' => 'required|integer',
        ]);

        $quizTaken = QuizTaken::create([
            'quiz_id' => $request->get('quiz_id'),
            'rating' => $request->get('rating'),
        ]);

        collect($request->get('answers'))->each(function ($q) use ($quizTaken) {
            $quizTaken->takenAnswers()->create([
                'quiz_question_id' => $q['question_id'],
                'quiz_answer_id' => $q['answer_id'],
            ]);
        });

        $quizTaken = QuizTaken::whereId($quizTaken->id)->with(['quiz', 'takenAnswers', 'takenAnswers.question', 'takenAnswers.answer'])->first();

        return response()->json([
            'success' => true,
            'errors' => null,
            'data' => $quizTaken
        ]);
    }
}
