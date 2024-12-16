<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // User related routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::prefix('user')->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
    });

    Route::get('/forgotpassword', function () {
        return view('forgotpassword');
    });

  

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
    });
});
