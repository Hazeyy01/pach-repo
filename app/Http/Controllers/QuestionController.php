<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemquestion;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Systemquestion::all();
        return response() -> json(array('questions' => $questions), 200);
    }

    public function index_milestone_id(string $milestone_id)
    {
        $questions = Systemquestion::where('milestone_id', '=', $milestone_id) -> get();
        return response() -> json(array('questions' => $questions), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createQuestion = Systemquestion::create([
            'question_id' => Str::uuid() -> toString(),
            'question_text' => $request -> input('question_text'),
            'milestone_id' => $request -> input('milestone_id')
        ]);

        return response() -> json(array('question' => $createQuestion), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Systemquestion::find($id);
        return response() -> json(array('question' => $question), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $question = Systemquestion::find($request -> input('question_id'));
        $updateQuestion = $question -> update($request -> all());
        return response() -> json(array('question' => $updateQuestion), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $question = Systemquestion::find($id);

        if (!empty($question)) {
            $deleteStatus = $question -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
