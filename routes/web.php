<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

Route::get('login/github', [LoginController::class, 'redirectToProvider'])->name('redirectToProvider');
Route::get('login/github/callback', [LoginController::class, 'handleProviderCallback'])->name('handleProviderCallback');

Route::get('login/google', [LoginController::class, 'redirectToProviderGoogle'])->name('redirectToProvider');
Route::get('login/google/callback', [LoginController::class, 'handleProviderCallbackGoogle'])->name('handleProviderCallback');
