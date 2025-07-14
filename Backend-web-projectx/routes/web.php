<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('start');
});


Route::get('profiel', function () {
    return view('profiel');
});

Route::get('addBook', function () {
    return view('addBook');
});

