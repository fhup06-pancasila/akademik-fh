<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OpenIdConnectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::get('/auth/redirect', [OpenIdConnectController::class, 'redirect'])->name('oidc.redirect');
    Route::get('/auth/callback', [OpenIdConnectController::class, 'callback'])->name('oidc.callback');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::view('/', 'dashboard')->middleware('auth')->name('dashboard');
