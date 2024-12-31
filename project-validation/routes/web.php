<?php

use App\Http\Controllers\UserController;
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

// Route::get('/add', [UserController::class, "Add_user"]);

Route::controller(UserController::class)->group(function ()
{
    Route::view('/add', 'adduser');

    Route::post('/add', 'Add_user')->name('adduser');
});