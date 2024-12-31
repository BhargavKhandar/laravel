<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageGeneratorController;

Route::get('/', [ImageController::class, 'showForm']);
Route::post('/generate-image', [ImageController::class, 'generate'])->name('generate');

Route::get('/upload', [ImageController::class, 'showImageForm'])->name('upload.form');
Route::post('/upload', [ImageController::class, 'upload'])->name('upload');

Route::get('/show-image/{imagePath}', [ImageController::class, 'showImage'])->name('show-image');
// Route::get('/image', [ImageController::class, 'image'])->name('image');
Route::get('/image', [ImageController::class, 'show'])->name('image');

Route::post('/process-form', [ImageController::class, 'processForm'])->name('processForm');
// Route::get('/show-analysis-result', [ImageController::class, 'showAnalysisResult'])->name('showAnalysisResult');
Route::get('/show-image', [ImageController::class, 'analyzeimage'])->name('showImage');

Route::post('/analyze-image', [ImageController::class, 'analyze'])->name('analyze-image');
Route::post('/anlyz-img', [ImageController::class, 'analyzeImageup'])->name('anlyz-img');


Route::view('/detect', 'detect-image');
// Route::post('/object', [ImageController::class, 'detectObjects'])->name('object');
