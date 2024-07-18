<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   
    public function showSponsorPage()
    {
        $sponsorships = [
            'basic' => 2.99,
            'standard' => 5.99,
            'premium' => 9.99,
        ];
        return view('admin.sponsor', compact('sponsorships'));
    }
}
