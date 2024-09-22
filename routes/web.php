<?php

use App\Http\Controllers\ShowProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/register');
Route::get('/company/profile', [ShowProfileController::class, 'show'])->name('profile.show');


// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
