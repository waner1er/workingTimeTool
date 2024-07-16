<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('welcome');


Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', \App\Livewire\TimeArchive::class)->name('dashboard');
    Route::get('/app', [\App\Http\Controllers\WorkingToolController::class, 'app'])->name('app');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
