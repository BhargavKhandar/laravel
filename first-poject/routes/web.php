<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/post', function () {
    return view('post');
});

Route::get('/', [PageController::class, 'showUser']);

// this is name method to call post.php && we can give any name in post of Route::get(/post) ex.(/postsssss, /page/post, etc.)
// Route::get('/post', function () {
//     return view('post');
// })->name('mypost');

// show page is show the different value in web page (The page under the folder.)
// Route::get('/show', function () {
//     return view('property.show');
// });

// Route::get('/include', function () {
//     return view('property.include');
// });

// call any page simple mahtod
// Route::get('/post', function () {
//     return view('post');
// });

// sort form for call the page
// Route::view('post','/post');

// after get letter use in url to call this page
// Route::get('/post/first', function () {
//     return view('first');
// });