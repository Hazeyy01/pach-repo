<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemchildren;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childrens = Systemchildren::all();
        return response() -> json(array('childrens' => $childrens), 200);
    }

    public function index_parent_id(string $parent_id)
    {
        $childrens = Systemchildren::where('parent_id', '=', $parent_id) -> get();
        return response() -> json(array('childrens' => $childrens), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createChildren = Systemchildren::create([
            'children_id' => Str::uuid() -> toString(),
            'children_name' => $request -> input('children_name'),
            'children_gender' => $request -> input('children_gender'),
            'children_birthdate' => $request -> input('children_birthdate'),
            'children_weight' => $request -> input('children_weight'),
            'children_height' => $request -> input('children_height'),
            'children_head_circumference' => $request -> input('children_head_circumference'),
            'parent_id' => $request -> input('parent_id')
        ]);

        return response() -> json(array('children' => $createChildren), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $children = Systemchildren::find($id);
        return response() -> json(array('children' => $children), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $children = Systemchildren::find($request -> input('children_id'));
        $updateChildren = $children -> update($request -> all());
        return response() -> json(array('children' => $updateChildren), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $children = Systemchildren::find($id);

        if (!empty($children)) {
            $deleteStatus = $children -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
