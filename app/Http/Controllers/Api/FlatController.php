<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {

        $flats = Flat::with(['user', 'services'])->get();

        $data = [
            'success' => true,
            'results' => $flats,
        ];

        return response()->json($data);
    }
    public function search(Request $request)
    {

        $latitude = $request->all()['latitude'];
        $longitude = $request->all()['longitude'];

        $flats = Flat::with(['services', 'user'])
            ->where('latitude', '>=', $latitude - 10000)
            ->where('latitude', '<=', $latitude + 10000)
            ->where('longitude', '>=', $longitude - 10000)
            ->where('longitude', '<=', $longitude + 10000)
            ->get();

        return  response()->json([
            'success' => true,
            'results' => $flats,
        ]);
    }

    public function createSquare($lat, $lon)
    {
        $center = [$lat, $lon];
        $diagonale = sqrt(2 * 4000);
    }
}
