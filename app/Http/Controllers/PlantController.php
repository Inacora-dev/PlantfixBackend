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
    public function index(Request $request)
    {
        $query = Plant::with('plantFamily');

        if ($request->has('family')) {
            $query->where('plant_family_id', $request->input('family'));
        }

        if ($request->has('sortBy')) {
            switch ($request->input('sortBy')) {
                case 'priceAsc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    break; 
            }
        }

        $perPage = $request->input('perPage', 8);
        $plants = $query->paginate($perPage);

        return response()->json($plants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        $validated = $request->validated();

        $plant = Plant::create($validated);

        return response()->json( $plant, 201);

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
    $familyId = $request->input('family');

    $plants = Plant::with('plantFamily')
        ->when($query, function ($q) use ($query) {
            $q->where(function ($subquery) use ($query) {
                $subquery->where('name', 'like', "%{$query}%")
                    ->orWhere('price', $query)
                    ->orWhereHas('plantFamily', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    });
            });
        })
        ->when($familyId, function ($q) use ($familyId) {
            $q->where('plant_family_id', $familyId);
        })
        ->paginate(8);

    return response()->json($plants);
}

}
