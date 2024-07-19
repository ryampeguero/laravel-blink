<?php

use App\Http\Controllers\Api\FlatController;

use App\Http\Controllers\Api\ReaderAuthController;
use App\Http\Controllers\UserAuthController;
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


Route::post('register', [ReaderAuthController::class, 'register']);
Route::post('login', [ReaderAuthController::class, 'login'])->name('login');
Route::post('logout', [ReaderAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->put('login', [UserAuthController::class, 'authenticateWithToken']);


Route::get('/flats/search', [FlatController::class, 'search']);


Route::get('payment/token', [PaymentController::class, 'token']);
Route::post('payment/checkout', [PaymentController::class, 'checkout']);



