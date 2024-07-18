<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {

        $flats = Flat::with('services')->get();

        $data = [
            'success' => true,
            'results' => $flats,
        ];

        return response()->json($data);
    }

    public function search(Request $request) {

        $latitude = $request->all()['latitude'];
        $longitude = $request->all()['longitude'];

        $flats = Flat::with('services')->where('latitude', $latitude)->where('longitude', $longitude)->get();

        return  response()->json([
            'success' => true,
            'results' => $flats,
        ]);
        
    }


}
