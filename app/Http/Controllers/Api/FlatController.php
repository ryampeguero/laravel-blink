<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Service;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    private $flatAR = [];

    private $idServ;

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
            ->where('visible', 1)
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
        $this->services = $data['services'] ? $data['services'] : 0;
        $this->range = $data['range'] ? $data['range'] : 1;
        $this->km = $this->latitude + $this->range / 111;

        if ($this->services == 0) {

            $this->flatAR = Flat::with(['services', 'user'])
                ->where('latitude', '>=', $this->latitude - $this->range)
                ->where('latitude', '<=', $this->latitude + $this->range)

                ->where('longitude', '>=', $this->longitude - $this->range)
                ->where('longitude', '<=', $this->longitude + $this->range)
                ->where('rooms', '>=', $this->rooms)
                ->where('bathrooms', '>=', $this->bathrooms)
                ->where('visible', 1)
                ->orderByDesc('rooms')
                ->get();
        } else {

            foreach ($this->services as $key => $idServ) {
                $this->idServ = $idServ;
                $flat = Service::query()->joinRelation('flats', function ($join, $pivot) {
                    $pivot->where('service_id', $this->idServ);
                })
                    ->where('latitude', '>=', $this->latitude - $this->range)
                    ->where('latitude', '<=', $this->latitude + $this->range)

                    ->where('longitude', '>=', $this->longitude - $this->range)
                    ->where('longitude', '<=', $this->longitude + $this->range)
                    ->where('rooms', '>=', $this->rooms)
                    ->where('bathrooms', '>=', $this->bathrooms)
                    ->where('visible', 1)

                    ->with('flats')->get();

                if (count($this->flatAR) == 0) {
                    $this->flatAR = $flat;
                } else {
                    $this->flatAR = $flat->merge($this->flatAR);
                }
            }
        }

        return response()->json([
            'success' => true,
            'results' => $this->flatAR,
            'range' => $this->km,
            'services' => $data['services'],
        ]);
    }

    public function info(Request $request)
    {

        $slug = $request->route('slug');

        $flat = Flat::with(['user','services'])->where('slug', $slug)->first();

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

    public function searchPremium(Request $request)
    {
        $data = $request->all();

        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->range = $data['range'] ? $data['range'] : 1;

        // Calcola il raggio in chilometri
        $this->km = $this->latitude + $this->range / 111;

        $currentDateTime = Carbon::now();

        $planIds = DB::table('receipts')
            ->where('expire_date', '>', $currentDateTime)
            ->pluck('plan_id');

        $flats = Flat::with(['services', 'user', 'receipts'])
            ->where('latitude', '>=', $this->latitude - $this->range)
            ->where('latitude', '<=', $this->latitude + $this->range)
            ->where('longitude', '>=', $this->longitude - $this->range)
            ->where('longitude', '<=', $this->longitude + $this->range)
            ->whereIn('id', function ($query) use ($planIds) {
                $query->select('flat_id')
                    ->from('receipts')
                    ->whereIn('plan_id', $planIds)->groupBy('plan_id')->orderBy('plan_id');
            })->get();

        return response()->json([
            'success' => true,
            'results' => $flats,
        ]);
    }

    public function premiumFlats()
    {
        $flatsPrem = DB::table('flats')->rightJoin('receipts', 'flats.id', '=', 'receipts.flat_id')->where('plan_id', 3)->get();

        return response()->json([
            'success' => true,
            'results' => $flatsPrem,
        ]);
    }
}
