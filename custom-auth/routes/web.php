<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/home', [UserController::class, 'index'])->name('user.home');

Route::controller(UserController::class)->group(function ()
{
    // Home Page Route
    Route::get('/home', 'index')->name('home');

    // Login Routes
    Route::get('/login', 'login')->name('login');
    Route::post('/signin', 'signin')->name('signin');

    // Register Routes
    Route::get('/register', 'register')->name('registers');
    Route::post('/register', 'signup')->name('signup');

    // Verify OTP Routes
    Route::get('/verification/{id}', 'verification')->name('verification');
    Route::post('/verified', 'verifiedOtp')->name('verifyOtp');

    // Resend OTP Route
    Route::post('/resendOtp', 'resendOtp')->name('resendOtp');

    // Logout Route
    Route::post('/logout', 'logout')->name('logout');

    // Forget Password Routes
    Route::get('/forgetpassword', 'forgetpassword')->name('forgetpassword');
    Route::post('/email', 'sentMail')->name('email');

    // Reset Password Routes
    Route::get('/reset-password/{token}/{email}', 'showResetForm')->name('showResetForm');
    Route::post('/reset-password', 'reset')->name('update');
});
