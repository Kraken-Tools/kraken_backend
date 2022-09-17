<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolsController;



Route::prefix('auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('tools')->group(function() {
    Route::get('/number-in-full/{number?}', [ToolsController::class, 'numberInFull']);
    Route::post('/spell-checker', [ToolsController::class, 'spellChecker']);
});
