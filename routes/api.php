<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('events', EventController::class);
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()->except(['update']); 
    // we dont wnat update method
// scope means that this attendee and resources are always part of an event.
// And basically this means that if you would use route model binding to get an attendee, Laravel will
// automatically load it by looking only for the attendees of a parent event.
// Now the routes for this controller will have both parameters, the event and attendee, 
// and they will be both required.