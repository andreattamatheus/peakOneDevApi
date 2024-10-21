<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SuccessfulEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware(['auth:sanctum', 'throttle:30,1'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);

        Route::apiResource('emails', SuccessfulEmailController::class);
    });
});
Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});
