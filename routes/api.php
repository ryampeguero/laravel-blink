<?php

use App\Http\Controllers\Api\FlatController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\SearchController;
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

Route::get('/flats/search', [FlatController::class, 'search']);


Route::get('payment/token', [PaymentController::class, 'token']);
Route::post('payment/checkout', [PaymentController::class, 'checkout']);

