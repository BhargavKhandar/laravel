<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('hello', [UserController::class, 'hello']);

// this is url for call the hello mehtod using api
// http://localhost:8000/api/hello
