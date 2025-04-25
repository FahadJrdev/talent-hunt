<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosition;
use App\Models\ChatbotFlow;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function index()
    {
        // Get the active job position (for now, just get the first active one)
        $jobPosition = JobPosition::where('status', 'active')->first();
        
        return view('chatbot.index', [
            'jobPosition' => $jobPosition,
        ]);
    }
    
    public function uploadCV(Request $request): JsonResponse
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);
        
        // Store the file
        $path = $request->file('cv')->store('cvs', 'public');
        
        // Create a session ID if not exists
        $sessionId = $request->session()->get('chatbot_session_id') ?? Str::uuid();
        $request->session()->put('chatbot_session_id', $sessionId);
        
        // In a real app, you'd extract data from the CV
        // For now, we'll return mock data
        return response()->json([
            'success' => true,
            'file_path' => $path,
            'candidate' => [
                'name' => 'Marlene Rodríguez',
                'phone' => '5522334455',
                'email' => 'marlene@example.com',
                'address' => 'Ciudad del Valle, CDMX',
            ]
        ]);
    }
}