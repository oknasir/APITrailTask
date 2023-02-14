<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
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
            'title' => 'required|string',
            'description' => 'required|string',
            'publish' => 'required|boolean',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.mandatory' => 'boolean',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.answer' => 'required|string',
            'questions.*.answers.*.correct' => 'boolean',
        ]);

        $quiz = Quiz::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'active' => $request->get('publish'),
        ]);

        collect($request->get('questions'))->each(function ($q) use ($quiz) {
            $question = $quiz->questions()->create([
                'question' => $q['question'],
                'mandatory' => $q['mandatory'],
            ]);

            collect($q['answers'])->each(function ($a) use ($question) {
                $question->answers()->create([
                    'answer' => $a['answer'],
                    'correct' => $a['correct'],
                ]);
            });
        });

        $quiz = Quiz::whereId($quiz->id)->with(['questions', 'questions.answers'])->first();

        return response()->json([
            'success' => true,
            'errors' => null,
            'data' => $quiz
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $quiz = Quiz::whereId($id)->with(['questions', 'questions.answers'])->first();

        return response()->json([
            'success' => true,
            'errors' => null,
            'data' => $quiz
        ]);
    }
}
