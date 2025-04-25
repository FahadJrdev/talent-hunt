<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('job-positions', App\Http\Controllers\JobPositionController::class);

Route::apiResource('applications', App\Http\Controllers\ApplicationController::class);

Route::apiResource('chatbot-flows', App\Http\Controllers\ChatbotFlowController::class);

Route::apiResource('chatbot-steps', App\Http\Controllers\ChatbotStepController::class);

Route::apiResource('conversation-logs', App\Http\Controllers\ConversationLogController::class);

Route::post('/upload-cv', [App\Http\Controllers\ChatbotController::class, 'uploadCV']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});