<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function read(Request $request): JsonResponse
    {
        try {
            $city = isset($request->id) ? City::find($request->id) : City::all();

            return parent::output(
                $city
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when searching address by params: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when searching city by id.'], 500);
        }
    }
    
}
