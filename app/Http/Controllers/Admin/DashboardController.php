<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Flat;
use App\Models\Message;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $messages = Message::with(['flat'])->where('user_id', $user_id)->orderByDesc('id')->get();
        $views = DB::table('views')->rightJoin('flats', 'flats.id', '=', 'flat_id')->where('user_id', $user_id)
            ->get();

        return view('admin.dashboard', compact('views', 'user','messages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        // dd($message);

        $message->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Messaggio eliminato con successo.');
    }
}
