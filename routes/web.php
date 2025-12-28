<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/channels', function () {
    return view('channels');
});

Route::get('/country', [CountryController::class, 'index']);

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/hotel', function () {
    return view('hotel');
});

Route::get('/menu', function () {
    return view('menu');
});

// Route::get('/watch/{channel}', function ($channel) {
//     return view('watch', compact('channel'));
// });
Route::get('/player', [CountryController::class, 'player'])->name('player');


Route::get('/tz', function () {
    return view('countries.tz');
});

Route::get('/show/{country_code}', [CountryController::class, 'showChannels']);