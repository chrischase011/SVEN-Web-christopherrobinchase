<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/generate-token', [APIController::class, 'generate_token']);

Route::post('/book-schedule', [APIController::class, 'book_schedule'])->middleware('auth:sanctum');