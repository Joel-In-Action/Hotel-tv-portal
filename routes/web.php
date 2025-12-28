<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/country', [CountryController::class, 'allChannels'])->name('channels');

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/hotel', function () {
    return view('hotel');
});

Route::get('/menu', function () {
    return view('menu');
});

// Player route
Route::get('/player', [CountryController::class, 'player'])->name('player');

// Show channels by country
Route::get('/show/{country_code}', [CountryController::class, 'showChannels'])->name('country.show');
