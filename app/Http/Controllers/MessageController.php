<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
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
}
