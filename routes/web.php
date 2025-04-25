<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('chatbot.index');
});

Route::post('/api/upload-cv', [App\Http\Controllers\ChatbotController::class, 'uploadCV']);
