<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    
    Route::get('/jobs', [JobController::class, 'index']);

    Route::post('/jobs/{id}/apply', [JobController::class, 'apply']);

});
