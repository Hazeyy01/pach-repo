<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemmilestone;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milestones = Systemmilestone::all();
        return response() -> json(array('milestones' => $milestones), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createMilestone = Systemmilestone::create([
            'milestone_id' => Str::uuid() -> toString(),
            'milestone_name' => $request -> input('milestone_name'),
            'milestone_category' => $request -> input('milestone_category')
        ]);

        return response() -> json(array('milestone' => $createMilestone), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $milestone = Systemmilestone::find($id);
        return response() -> json(array('milestone' => $milestone), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $milestone = Systemmilestone::find($request -> input('milestone_id'));
        $updateMilestone = $milestone -> update($request -> all());
        return response() -> json(array('milestone' => $updateMilestone), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $milestone = Systemmilestone::find($id);

        if (!empty($milestone)) {
            $deleteStatus = $milestone -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
