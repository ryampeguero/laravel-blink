<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $data = $request->all();
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $range = ($data['range'] ? $data['range'] : 1)/111;

        $km = $latitude + ($range/111);

        $flats = Flat::with(['services', 'user'])
            ->where('latitude', '>=', $latitude - $range)
            ->where('latitude', '<=', $latitude + $range)

            ->where('longitude', '>=', $longitude - $range)
            ->where('longitude', '<=', $longitude + $range)

            ->get();



        return  response()->json([
            'success' => true,
            'results' => $flats,
            'range' => $km
        ]);
    }

    public function info(Request $request) {

        $slug = $request->route('slug');
        $flat = Flat::where('slug', $slug)->first();

        return view("infoShow", compact('flat'));
    }
}
