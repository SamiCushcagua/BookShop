<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FAQController;

Route::get('/', function () {
    return view('start');
})->name('start');

Route::get('start', function () {
    return view('view.start');
})->name('view.start');

// Ruta para allUsers (mantener la que ya tenías)
Route::get('allUsers', [UserController::class, 'index'])->name('allUsers'); 

Route::get('dashboard', [BookController::class, 'index'])->name('dashboard');

Route::resource('books', BookController::class)->middleware('auth');

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
    
    
    Route::get('profile', function () {
        return view('view.profile');
    })->name('view.profile');
});



// Rutas públicas (para todos)
Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');
// Ruta para administrar FAQ (solo admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/faq/admin', [FAQController::class, 'admin'])->name('faq.admin');
});

// Rutas de administración (solo admins)
Route::middleware(['auth'])->group(function () {
    Route::get('/faq/create', [FAQController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FAQController::class, 'store'])->name('faq.store');
    Route::get('/faq/category/create', [FAQController::class, 'createCategory'])->name('faq.create-category');
    Route::post('/faq/category', [FAQController::class, 'storeCategory'])->name('faq.store-category');
    Route::delete('/faq/{question}', [FAQController::class, 'destroy'])->name('faq.destroy');
    Route::delete('/faq/category/{category}', [FAQController::class, 'destroyCategory'])->name('faq.destroy-category');
});



// AGREGAR ESTA LÍNEA AL FINAL:
require __DIR__.'/auth.php';