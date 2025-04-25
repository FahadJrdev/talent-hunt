<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatbotStepStoreRequest;
use App\Http\Requests\ChatbotStepUpdateRequest;
use App\Http\Resources\ChatbotStepCollection;
use App\Http\Resources\ChatbotStepResource;
use App\Models\ChatbotStep;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatbotStepController extends Controller
{
    public function index(Request $request): Response
    {
        $chatbotSteps = ChatbotStep::all();

        return new ChatbotStepCollection($chatbotSteps);
    }

    public function store(ChatbotStepStoreRequest $request): Response
    {
        $chatbotStep = ChatbotStep::create($request->validated());

        return new ChatbotStepResource($chatbotStep);
    }

    public function show(Request $request, ChatbotStep $chatbotStep): Response
    {
        return new ChatbotStepResource($chatbotStep);
    }

    public function update(ChatbotStepUpdateRequest $request, ChatbotStep $chatbotStep): Response
    {
        $chatbotStep->update($request->validated());

        return new ChatbotStepResource($chatbotStep);
    }

    public function destroy(Request $request, ChatbotStep $chatbotStep): Response
    {
        $chatbotStep->delete();

        return response()->noContent();
    }
}
