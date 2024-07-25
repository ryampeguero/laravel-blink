<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $flats = Flat::with(['messages'])->where('user_id', $user_id)->paginate(6);
        // dd();
        return view('admin.dashboard', compact('flats'));
    }

    public function destroy($id)
    {

        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Messaggio eliminato con successo.');
    }
}
