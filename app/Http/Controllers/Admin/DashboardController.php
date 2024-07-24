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
        $flatIds = Flat::where('user_id', $user_id)->pluck('id')->toArray();

        $messageArray = Message::where('flat_id', $flatIds)->paginate(5);

        // dd($flatsArray);
        return view('admin.dashboard', compact('messageArray'));
    }

    public function destroy($id)
    {

        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Messaggio eliminato con successo.');
    }
}
