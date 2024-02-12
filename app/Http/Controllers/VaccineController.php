<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemvaccine;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccines = Systemvaccine::all();
        return response() -> json(array('vaccines' => $vaccines), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createVaccine = Systemvaccine::create([
            'vaccine_id' => Str::uuid() -> toString(),
            'vaccine_name' => $request -> input('vaccine_name'),
            'vaccine_gender' => $request -> input('vaccine_gender'),
            'vaccine_age' => $request -> input('vaccine_age')
        ]);

        return response() -> json(array('vaccine' => $createVaccine), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vaccine = Systemvaccine::find($id);
        return response() -> json(array('vaccine' => $vaccine), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $vaccine = Systemvaccine::find($request -> input('vaccine_id'));
        $updateVaccine = $vaccine -> update($request -> all());
        return response() -> json(array('vaccine' => $updateVaccine), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $vaccine = Systemvaccine::find($id);

        if (!empty($vaccine)) {
            $deleteStatus = $vaccine -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
