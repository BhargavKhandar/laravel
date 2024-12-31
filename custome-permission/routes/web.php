<?php

use App\Http\Controllers\Permissioncontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\DashboardController;

Route::get('/', [Authcontroller::class, 'login'])->name('login');
Route::post('/', [Authcontroller::class, 'auth_login']);
Route::get('/logout', [Authcontroller::class, 'logout'])->name('logout');

Route::group(['middleware' => 'user_admin'], function () {
    Route::get('/panel/dashboard', [DashboardController::class, 'index'])->name('panel.dashboard');

    $routs = [
        "role" => Rolecontroller::class,
        "user" => Usercontroller::class,
        "permission" => Permissioncontroller::class,
    ];

    foreach ($routs as $name => $controller) {
        // List
        Route::get('/panel/' . $name, [$controller, 'list'])->name($name);
        // Create
        Route::get('/panel/' . $name . '/create/', [$controller, 'create'])->name('panel.' . $name . '.create');
        // Save
        Route::post('/panel/' . $name . '/save/', [$controller, 'save'])->name('panel.' . $name . '.save');
        // Edit
        Route::get('/panel/' . $name . '/edit/{id}', [$controller, 'edit'])->name('panel.' . $name . '.edit');
        // Update
        Route::post('/panel/' . $name . '/update/{id}', [$controller, 'update'])->name('panel.' . $name . '.update');
        // Delete
        Route::post('/panel/' . $name . '/delete/{id}', [$controller, 'destroy'])->name('panel.' . $name . '.delete');
    }
});
