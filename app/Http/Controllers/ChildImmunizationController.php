<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemvaccine;
use App\Models\ChildrenVaccine;
use App\Models\Childimmunization;

class ChildImmunizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function index_children_id(string $children_id)
    {
        $childrenVaccines = array();
        $childImmunizations = Childimmunization::where('children_id', '=', $children_id) -> get();
        foreach ($childImmunizations as $childImmunization) {
            if (!empty($childImmunization -> vaccine_id)) {
                $vaccine = Systemvaccine::find($childImmunization -> vaccine_id);

                if (!empty($vaccine)) {
                    $childrenVaccine = new ChildrenVaccine();

                    $childrenVaccine -> immunization = $childImmunization;
                    $childrenVaccine -> vaccine = $vaccine;

                    $childrenVaccines[] = $childrenVaccine;
                }
            } else {
                $childrenVaccine = new ChildrenVaccine();

                $childrenVaccine -> immunization = $childImmunization;

                $childrenVaccines[] = $childrenVaccine;
            }
        }

        return response() -> json(array('childrenVaccines' => $childrenVaccines), 200);
    }

    public function index_immunization_vaccine(string $children_id)
    {
        $childrenVaccines = array();
        $vaccines = Systemvaccine::all();
        foreach ($vaccines as $vaccine) {
            $childrenVaccine = new ChildrenVaccine();

            $childrenVaccine -> vaccine = $vaccine;
            $childImmunization = Childimmunization::where('children_id', '=', $children_id) -> where('vaccine_id', '=', $vaccine -> vaccine_id) -> first();
            $childrenVaccine -> immunization = $childImmunization;

            $childrenVaccines[] = $childrenVaccine;
        }

        return response() -> json(array('childrenVaccines' => $childrenVaccines), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createChildImmunization = Childimmunization::create([
            'child_immunization_id' => Str::uuid() -> toString(),
            'child_immunization_date' => $request -> child_immunization_date,
            'child_immunization_type' => $request -> child_immunization_type,
            'vaccine_name' => $request -> vaccine_name,
            'vaccine_id' => $request -> vaccine_id,
            'children_id' => $request -> children_id
        ]);

        return response() -> json(array('childImmunization' => $createChildImmunization), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $childImmunization = Childimmunization::find($id);
        return response() -> json(array('childImmunization' => $childImmunization), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateStatus = false;
        $existChildImmunization = Childimmunization::find($request -> child_immunization_id);
        if (!empty($existChildImmunization)) {
            $existChildImmunization -> child_immunization_date = $request -> child_immunization_date;
            $existChildImmunization -> vaccine_name = $request -> vaccine_name;

            $updateStatus = $existChildImmunization -> save();
        }

        return response() -> json(array('updateStatus' => $updateStatus), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $childImmunization = Childimmunization::find($id);

        if (!empty($childImmunization)) {
            $deleteStatus = $childImmunization -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
