<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function chartData(Request $request)
    {
        $data = $request->all();

        $viewsMonth = DB::select("SELECT COUNT(views.`id`) AS 'Views', date_format(views.`created_at`,'%m-%y'), YEAR(views.`created_at`) 'year', MONTH(views.`created_at`) 'month' FROM `views` INNER JOIN `flats` ON flats.id = views.flat_id GROUP BY 'Views','year','month',views.`created_at`; ");

        return response()->json($viewsMonth);
    }
}
