<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Flat;
use App\Models\Message;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function storeMessage(Request $request)
    {

        $data = $request;

        $message = new Message();
        $message->message = $data['message'];
        $message->flat_id = $data['id_flat'];
        $message->email = $data['email'];
        $message->save();

        $lead = (object) [
            'name' => $data['email'],
            'email' => $data['email'],
            'message' => $data['message'],
        ];

        Mail::to('user@blink.it')->send(new NewContact($lead));

        return response()->json(['message' => 'Messaggio inviato con successo!'], 200);
    }

    public function showallmessage()
    {
        $user_id = Auth::id();
        $flatIds = Flat::where('user_id', $user_id)->pluck('id')->toArray();

        $messageArray = Message::where('flat_id', $flatIds)->get();

        // dd($flatsArray);
        return view('admin.message', compact('messageArray'));
    }

    public function destroy($id)
    {

        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route('admin.message')->with('success', 'Messaggio eliminato con successo.');
    }
}
