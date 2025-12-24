<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/channels', function () {
    return view('channels');
});

Route::get('/country', function () {
    return view('country');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/hotel', function () {
    return view('hotel');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/watch/{channel}', function ($channel) {
    return view('watch', compact('channel'));
});


Route::get('/tz', function () {
    return view('countries.tz');
});

Route::get('/show', function () {
    return view('show');
});