<?php

use Illuminate\Support\Facades\Route;



Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');



Route::middleware(['auth'])->group(function () {
    Route::get('/', \App\Livewire\Home::class)->name('home');
    Route::get('/dashboard', \App\Livewire\TimeArchive::class)->name('dashboard');
    Route::get('/app', \App\Livewire\Application::class)->name('app');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
