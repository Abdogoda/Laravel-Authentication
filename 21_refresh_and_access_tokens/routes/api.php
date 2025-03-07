<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function(){
    return "TEST API";
});

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('refresh-token', [AuthenticationController::class, 'refreshToken'])->middleware('ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value);
    
    Route::get('profile', [AuthenticationController::class, 'profile']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
});