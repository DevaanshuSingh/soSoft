<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('getPlaces/{userData}', [PlaceController::class, 'getPlaces']);
Route::post('sendEmail', [MailController::class, 'sendEmail']);
