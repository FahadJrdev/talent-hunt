<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/upload-cv', [ChatbotController::class, 'uploadCV'])->name('upload-cv');
