<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Message;
use App\Models\Service;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    private $latitude;

    private $longitude;

    private $rooms;

    private $bathrooms;

    private $range;

    private $km;

    private $services;

    public function index()
    {

        $flats = Flat::with(['user', 'services'])->get();

        $data = [
            'success' => true,
            'results' => $flats,
        ];

        return response()->json($data);
    }

    public function basicSearch(Request $request)
    {
        $data = $request->all();
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $range = ($data['range'] ? $data['range'] : 1) / 111;

        $km = $latitude + $range;

        $flats = Flat::with(['services', 'user'])
            ->where('latitude', '>=', $latitude - $range)
            ->where('latitude', '<=', $latitude + $range)

            ->where('longitude', '>=', $longitude - $range)
            ->where('longitude', '<=', $longitude + $range)

            ->get();

        return [
            'flats' => $flats,
            'km' => $km,
        ];
    }

    public function search(Request $request)
    {

        $resp = $this->basicSearch($request);

        return response()->json([
            'success' => true,
            'results' => $resp['flats'],
            'range' => $resp['km'],
        ]);
    }

    public function searchAR(Request $request)
    {
        $data = $request->all();

        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->rooms = $data['rooms'] ? $data['rooms'] : 1;
        $this->bathrooms = $data['bathrooms'] ? $data['bathrooms'] : 1;
        $this->services = $data['services'];
        $this->range = $data['range'] ? $data['range'] : 1;
        $this->km = $this->latitude + $this->range / 111;

        $flats = Flat::with(['services', 'user'])
            ->where('latitude', '>=', $this->latitude - $this->range)
            ->where('latitude', '<=', $this->latitude + $this->range)

            ->where('longitude', '>=', $this->longitude - $this->range)
            ->where('longitude', '<=', $this->longitude + $this->range)
            ->where('rooms', '>=', $this->rooms)
            ->where('bathrooms', '>=', $this->bathrooms)

            ->orderByDesc('rooms')
            ->get();

        return response()->json([
            'success' => true,
            'results' => $flats,
            'range' => $this->km,
            'services' => $data['services'],
        ]);
    }

    public function info(Request $request)
    {

        $slug = $request->route('slug');
        $flat = Flat::with(['user'])->where('slug', $slug)->first();

        return response()->json($flat);
    }

    public function getAllServices()
    {
        $services = Service::all();

        return response()->json([
            'success' => true,
            'results' => $services,
        ]);
    }

    public function storeMessage(Request $request)
    {

        //validazioni
        $validated = $request->validate([
            'email' => 'required',
            'message' => 'required',
        ]);

        //creazione del nuovo messaggio
        $newMessage = new Message();
        $newMessage->fill($validated);
        $newMessage->save();

        //risposta JSON
        return response()->json([
            'success' => true,
            'result' => $newMessage,
        ]);
    }

    public function searchPremium(Request $request)
    {
        $data = $request->all();

        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->rooms = $data['rooms'] ? $data['rooms'] : 1;
        $this->bathrooms = $data['bathrooms'] ? $data['bathrooms'] : 1;
        $this->services = $data['services'];
        $this->range = $data['range'] ? $data['range'] : 1;
        $this->km = $this->latitude + $this->range / 111;

        $currentDateTime = Carbon::now();
        $flatIdsWithReceipts = DB::table('receipts')
            ->where('expire_date', '>', $currentDateTime)
            ->orderBy('flat_id', 'desc')
            ->pluck('flat_id');

        $flats = Flat::with(['services', 'user'])
            ->where('latitude', '>=', $this->latitude - $this->range)
            ->where('latitude', '<=', $this->latitude + $this->range)
            ->where('longitude', '>=', $this->longitude - $this->range)
            ->where('longitude', '<=', $this->longitude + $this->range)
            ->where('rooms', '>=', $this->rooms)
            ->where('bathrooms', '>=', $this->bathrooms)
            ->whereIn('id', $flatIdsWithReceipts)
            ->orderByDesc('rooms')
            ->get();

        return response()->json([
            'success' => true,
            'results' => $flats,
            'range' => $this->km,
            'services' => $data['services'],
        ]);
    }
}
