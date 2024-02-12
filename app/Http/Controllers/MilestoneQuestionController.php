<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuestionStatus;
use App\Models\Systemquestion;
use App\Models\Childdevelopment;

class MilestoneQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function index_milestone_id_children_id(string $milestone_id, string $children_id)
    {
        $questionStatusList = array();
        $questions = Systemquestion::where('milestone_id', '=', $milestone_id) -> get();
        foreach ($questions as $question) {
            $questionStatus = new QuestionStatus();
            $questionStatus -> question = $question;

            $childdevelopment = Childdevelopment::where('children_id', '=', $children_id) -> where('milestone_id', '=', $milestone_id) -> where('question_id', '=', $question -> question_id) -> get();
            if (count($childdevelopment) == 0) {
                $questionStatus -> childdevelopment = null;
            } else {
                $questionStatus -> childdevelopment = $childdevelopment[0];
            }

            $questionStatusList[] = $questionStatus;
        }
        return response() -> json(array('questionstatuslist' => $questionStatusList), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
