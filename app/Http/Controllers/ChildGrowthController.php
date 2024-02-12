<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Childgrowth;

class ChildGrowthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childGrowths = Childgrowth::all();
        return response() -> json(array('childGrowths' => $childGrowths), 200);
    }

    public function index_children_id(string $children_id)
    {
        $childGrowths = ChildGrowth::where('children_id', '=', $children_id) -> get();
        return response() -> json(array('childGrowths' => $childGrowths), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createChildGrowth = Childgrowth::create([
            'growth_id' => Str::uuid() -> toString(),
            'growth_weight' => $request -> input('growth_weight'),
            'growth_height' => $request -> input('growth_height'),
            'growth_head_circumference' => $request -> input('growth_head_circumference'),
            'growth_bmi' => $request -> input('growth_bmi'),
            'growth_date_taken' => $request -> input('growth_date_taken'),
            'growth_age_taken' => $request -> input('growth_age_taken'),
            'children_id' => $request -> input('children_id')
        ]);

        return response() -> json(array('childGrowth' => $createChildGrowth), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $childGrowth = Childgrowth::find($id);
        return response() -> json(array('childGrowth' => $childGrowth), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $childGrowth = Childgrowth::find($request -> input('growth_id'));
        $updateChildGrowth = $childGrowth -> update($request -> all());
        return response() -> json(array('childGrowth' => $updateChildGrowth), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $childGrowth = ChildGrowth::find($id);

        if (!empty($childGrowth)) {
            $deleteStatus = $childGrowth -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
