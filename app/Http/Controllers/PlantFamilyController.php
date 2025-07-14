<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantFamilyController extends Controller
{
    public function index()
    {
        return response()->json(PlantFamily::all());
    }
}
