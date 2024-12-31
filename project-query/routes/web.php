<?php

use App\Http\Controllers\EmployeeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// direct call controller file
// Route::get('/', [EmployeeController::class, "Show_employee"])->name('home');

Route::controller(EmployeeController::class)->group(function ()
{
    Route::get('/', 'Show_employee')->name('home');
    
    Route::get('/employee/{id}', 'Single_employee')->name('view.employee');
    
    Route::post('/add', 'Add_employee')->name('add_employee');
    
    Route::put('/update/{id}', 'Update_employee')->name('update.employee');
    Route::get('/updatepage/{id}', 'UpdatePage')->name('update.page');
    
    Route::get('/delete/{id}', 'Delete_employee')->name('delete.employee');
    
    Route::get('/deleteall', 'Delete_all_employee');
    
    Route::view('add_employee', 'add_employee');
});

