<?php

use App\Http\Controllers\Api\FlatController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReaderAuthController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/flats', [FlatController::class, 'index']);

Route::get('info/{slug}', [FlatController::class, 'info']);
Route::post('register', [ReaderAuthController::class, 'register']);
Route::post('login', [ReaderAuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return Auth::user();

    // Route::post('logout', [ReaderAuthController::class, 'logout']);
});

//Ricerca appartamenti
Route::get('/flats/search', [FlatController::class, 'search']);
Route::get('/flats/searchAR', [FlatController::class, 'searchAR']);
Route::get('/flats/services', [FlatController::class, 'getAllServices']);
Route::get('/flats/searchpremium', [FlatController::class, 'searchPremium']);
Route::get('/flats/premium', [FlatController::class, 'premiumFlats']);
//Pagamenti
Route::get('payment/token', [PaymentController::class, 'token']);
Route::post('payment/checkout', [PaymentController::class, 'checkout']);

//Messaggi
Route::post('/send-message', [MessageController::class, 'storeMessage']);

//Statistiche
Route::post('/stats/view',[StatsController::class, 'views']);