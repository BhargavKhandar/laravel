<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student', [StudentController::class, 'Show_students']);

Route::get('/union', [StudentController::class, 'Union_data']);

Route::get('/when', [StudentController::class, 'When_data']);

Route::get('/chunk', [StudentController::class, 'Chunk_data']);

Route::get('/raw ', [StudentController::class, 'Raw_queries']);
