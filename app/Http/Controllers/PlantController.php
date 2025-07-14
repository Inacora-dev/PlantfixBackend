<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantFamily;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlantRequest;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::with('plantFamily')->paginate(8);
        return response()->json($plants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        $validated = $request->validated();

        $plant = Plant::create($validated);

        return response()->json($plant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        $plant->load('plantFamily');
        return response()->json($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlantRequest $request, Plant $plant)
    {
        $validated = $request->validated();

        $plant->update($validated);

        return response()->json($plant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
{

    $query = $request->input('q');



    $plants = Plant::where('name', 'like', "%{$query}%")->paginate(8);

    return response()->json($plants);
}
}
