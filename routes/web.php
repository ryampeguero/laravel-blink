<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlatController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Route::middleware('auth')
    ->prefix('admin') // Prefisso nell'url delle rotte di questo gruppo
    ->name('admin.') // inizio di ogni nome delle rotte del gruppo
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('flats', FlatController::class)->except(['destroy'])->parameters(['flats' => 'flat:slug']);

        Route::get('/sponsor/{slug}', [FlatController::class, 'showSponsorPage'])->name('sponsor');
        Route::get('/message', [MessageController::class, 'showallmessage'])->name('message');
        Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('message.destroy');

    });

require __DIR__.'/auth.php';
