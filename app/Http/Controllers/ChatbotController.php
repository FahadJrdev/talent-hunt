<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function uploadCV(Request $request): JsonResponse
    {
        // Handle the CV upload logic here
        // For example, you can save the file to storage and return a response

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('cvs');

            return response()->json(['path' => $path], 200);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
