<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('start');
})->name('start');


Route::get('profiel', function () {
    return view('profiel');
})->name('profiel');


Route::get('start', function () {
    return view('view.start');
})->name('view.start');


Route::get('allUsers', function () {
    return view('allUsers');
})->name('allUsers');



Route::middleware('auth')->group(function () {
    Route::get('addBook', function () {
        return view('addBook');
    })->name('addBook');
    
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('profile', function () {
        return view('view.profile');
    })->name('view.profile');
});



// AGREGAR ESTA LÍNEA AL FINAL:
require __DIR__.'/auth.php';