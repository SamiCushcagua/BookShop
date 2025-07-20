<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('start');
})->name('start');

Route::get('start', function () {
    return view('view.start');
})->name('view.start');

// Ruta para allUsers (mantener la que ya tenías)
Route::get('allUsers', [UserController::class, 'index'])->name('allUsers');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('profiel/{user?}', [ProfileController::class, 'index'])->name('profiel');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update-image');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    // Rutas para gestión de usuarios (solo admins)
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggle-role');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
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