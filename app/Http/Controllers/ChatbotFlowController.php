<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatbotFlowStoreRequest;
use App\Http\Requests\ChatbotFlowUpdateRequest;
use App\Http\Resources\ChatbotFlowCollection;
use App\Http\Resources\ChatbotFlowResource;
use App\Models\ChatbotFlow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatbotFlowController extends Controller
{
    public function index(Request $request): ChatbotFlowCollection
    {
        $chatbotFlows = ChatbotFlow::all();

        return new ChatbotFlowCollection($chatbotFlows);
    }

    public function store(ChatbotFlowStoreRequest $request): ChatbotFlowResource
    {
        $chatbotFlow = ChatbotFlow::create($request->validated());

        return new ChatbotFlowResource($chatbotFlow);
    }

    public function show(Request $request, ChatbotFlow $chatbotFlow): ChatbotFlowResource
    {
        return new ChatbotFlowResource($chatbotFlow);
    }

    public function update(ChatbotFlowUpdateRequest $request, ChatbotFlow $chatbotFlow): ChatbotFlowResource
    {
        $chatbotFlow->update($request->validated());

        return new ChatbotFlowResource($chatbotFlow);
    }

    public function destroy(Request $request, ChatbotFlow $chatbotFlow): Response
    {
        $chatbotFlow->delete();

        return response()->noContent();
    }
}
