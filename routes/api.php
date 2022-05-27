<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AgentController;
use App\Http\Controllers\API\v1\BookingController;
use App\Http\Controllers\API\v1\PropertyController;


Route::group(['prefix' => 'v1'], function () {
   
    //properties
    Route::apiResource('/properties', PropertyController::class);
    Route::post('/reviews', [PropertyController::class, 'review'])->name('reviews');

    //bookings
    Route::resource('/bookings', BookingController::class);

    //agents
    Route::get('/agents/{user}', [AgentController::class, 'show'])->name('agents');

      //users
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

}); 