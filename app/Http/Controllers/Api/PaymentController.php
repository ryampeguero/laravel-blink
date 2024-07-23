<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Plan;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $token = $gateway->clientToken()->generate();
        // dd($token);

        return response()->json(['token' => $token]);
    }

    //gestiamo la transazione
    public function checkout(Request $request)
    {

        $validated = $request->all();

        $plan = Plan::where('price', $validated['planId'])->first();

        //  return dd($request);

        //recuperiamo dati 
        $amount = $validated['amount'];
        $nonce = $validated['payment_method_nonce'];
        $flatId = $validated['flatId'];
        $planId = $plan->id;




        //creazione della transazione
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // return response()->json($result);
        //  dd($result->success);

        //gestione della risposta 
        if ($result->success) {
            $transactionId = $result->transaction->id;
            $flat = Flat::where('id', $flatId)->first();

            $now = Carbon::now();

            $expireDate = $now->addDays(3);
            $flat->plans()->attach($plan->id, ['date' => $now, 'expire_date' => $expireDate]);

            session()->flash('success_message', 'Pagamento completato con successo.');

            return response()->json([
                'success' => true,
                'redirect_url' => route('admin.flats.show', ['flat' => $flat->slug]),
                'transaction' => $result->transaction
            ]);

           

        } else {
            return response()->json([
                'success' => false,
                'message' => $result->message
            ]);
        }
    }
}

