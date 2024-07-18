<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $gateway;

    //istanza gateway per riutilizzo nei metodi
    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    //generiamo il token 
    public function token()
    {
        $token = $this->gateway->clientToken()->generate();

        // dd($token);

        return response()->json(['token' => $token]);
    }

    //gestiamo la transazione
    public function checkout(Request $request)
    {
        //recuperiamo dati 
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        //creazione della transazione
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        //gestione della risposta 
        if ($result->success) {
            return response()->json(['success' => true, 'transaction' => $result->transaction]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }

}
