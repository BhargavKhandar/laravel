<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     $routes = [
//         "permission" => PermissionController::class,
//         "role" => RoleController::class,
//         'article' => ArticleController::class,
//         'user' => UserController::class,
//     ];

//     foreach ($routes as $name => $controller) {
//         Route::get('/' . $name, [$controller, 'index'])->name($name);
//         Route::get('/' . $name . '/create', [$controller, 'create'])->name($name . '.create');
//         Route::post('/' . $name, [$controller, 'store'])->name($name . '.store');
//         Route::get('/' . $name . '/{id}/edit', [$controller, 'edit'])->name($name . '.edit');
//         Route::post('/' . $name . '/{id}', [$controller, 'update'])->name($name . '.update');
//         Route::post('/' . $name . '/{id}/delete', [$controller, 'destroy'])->name($name . '.destroy');
//     }
// });

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    $routes = [
        "permission" => PermissionController::class,
        "role" => RoleController::class,
        'article' => ArticleController::class,
        'user' => UserController::class,
    ];

    foreach ($routes as $name => $controller) {
        Route::get('/' . $name, [$controller, 'index'])->name($name);
        Route::get('/' . $name . '/create', [$controller, 'create'])->name($name . '.create');
        Route::post('/' . $name, [$controller, 'store'])->name($name . '.store');
        Route::get('/' . $name . '/{id}/edit', [$controller, 'edit'])->name($name . '.edit');
        Route::post('/' . $name . '/{id}', [$controller, 'update'])->name($name . '.update');
        Route::post('/' . $name . '/{id}/delete', [$controller, 'destroy'])->name($name . '.destroy');
    }
});

require __DIR__ . '/auth.php';
