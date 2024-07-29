<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Flat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function storeMessage(Request $request)
    {
        $data = $request->all();
        $user_id = Flat::findOrFail($data['flat_id'])->user_id;

        $message = new Message();
        $message->message = $data['message'];
        $message->user_id = $user_id;
        $message->flat_id = $data['flat_id'];
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
}
