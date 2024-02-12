<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Childdevelopment;

class ChildDevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createChildDevelopment = Childdevelopment::create([
            'development_id' => Str::uuid() -> toString(),
            'development_answer_date' => date('Y-m-d'),
            'development_answer_value' => $request -> development_answer_value,
            'children_id' => $request -> children_id,
            'milestone_id' => $request -> milestone_id,
            'question_id' => $request -> question_id
        ]);

        return response() -> json(array('childdevelopment' => $createChildDevelopment), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateChildDevelopment = new Childdevelopment();
        $existChildDevelopment = Childdevelopment::find($request -> development_id);
        if (!empty($existChildDevelopment)) {
            $existChildDevelopment -> development_answer_value = $request -> development_answer_value;
            $existChildDevelopment -> development_answer_date = date('Y-m-d');

            $updateChildDevelopment = $existChildDevelopment -> save();
        }

        return response() -> json(array('childdevelopment' => $updateChildDevelopment), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
