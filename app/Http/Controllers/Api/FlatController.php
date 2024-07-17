<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;

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
}
