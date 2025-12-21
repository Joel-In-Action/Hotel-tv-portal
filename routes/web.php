<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/channels', function () {
    return view('channels');
});

Route::get('/hotel', function () {
    return view('hotel');
});

Route::get('/menu', function () {
    return view('menu');
});