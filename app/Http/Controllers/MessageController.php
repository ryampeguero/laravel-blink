<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

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

        // Risposta di successo
        return response()->json(['message' => 'Messaggio inviato con successo!'], 200);
    }
}
