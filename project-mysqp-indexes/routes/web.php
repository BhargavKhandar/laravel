<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\SearchController;

Route::get('/', [SearchController::class, 'search'])->name('search');
Route::get('/post', [SearchController::class, 'search'])->name('search');
