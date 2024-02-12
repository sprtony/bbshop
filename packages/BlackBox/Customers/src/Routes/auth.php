<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{EmailVerificationController, LogoutController};

use Livewire\Volt\Volt;
use App\Livewire\Auth\Passwords\Confirm;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')->name('login');
    Volt::route('register', 'auth.register')->name('register');
});

Route::prefix('password/reset')->group(function () {
    Volt::route('/', 'auth.passwords.email')->name('password.request');
    Volt::route('{token}', 'auth.passwords.reset')->name('password.reset');
});


Route::middleware('auth')->group(function () {

    Volt::route('email/verify', 'auth.verify')
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Volt::route('password/confirm', 'auth.passwords.confirm')
        ->name('password.confirm');




    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
