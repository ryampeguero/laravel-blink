<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Message;
use App\Models\View;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $flats = Flat::with(['messages'])->where('user_id', $user_id)->paginate(6);
        $views = View::all();
        return view('admin.dashboard', compact('flats', 'views'));
    }

    public function destroy($id)
    {

        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Messaggio eliminato con successo.');
    }
}
