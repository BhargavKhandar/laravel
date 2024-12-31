<?php

use App\Http\Controllers\CommentController;
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

// Check the route using terminal
// Command :- php artisan route:list --name=users(route name)
// this method show this route list

// this route method use without this file routes
// Route::resource('users', UserController::class)->except([
//     'create', 'update'
// ]);

// this route method use with specific routes
// Route::resource('users', UserController::class)->only([
//     'create', 'update', 'show'
// ]);

// this route method use to declare custom routes name
// Route::resource('users', UserController::class)->names([
//     'create' => 'users.build',
//     'show' => 'users.view',
// ]);

// this resource route the perent route is users and child route is comment
Route::resource('users.comments', CommentController::class)->shallow();
