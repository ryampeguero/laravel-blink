<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;


class StatsController extends Controller
{
    function views(Request $request)
    {
        $message = 'IP già presente';
        $result = false;

        $ip = $request->all()['ip'];
        $flatId = $request->all()['flatId'];

        $todayDate = Carbon::now();
        
        // dd($todayDate);
        $view = View::where('ip_address', $ip)->where('flat_id', $flatId)->where('created_at', '<', $todayDate)->get();

        if (count($view) == 0) {
            $newView = new View();
            $newView->ip_address = $ip;
            $newView->flat_id = $flatId;
            $newView->save();
            $message = 'IP nuovo inserito';
            $result = true;
        }
        
        $data = [
            'result' => $result,
            'message' => $message
        ];

        return response()->json($data);
    }
}
