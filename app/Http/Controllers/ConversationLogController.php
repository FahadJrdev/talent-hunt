<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversationLogStoreRequest;
use App\Http\Requests\ConversationLogUpdateRequest;
use App\Http\Resources\ConversationLogCollection;
use App\Http\Resources\ConversationLogResource;
use App\Models\ConversationLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConversationLogController extends Controller
{
    public function index(Request $request): ConversationLogCollection
    {
        $conversationLogs = ConversationLog::all();

        return new ConversationLogCollection($conversationLogs);
    }

    public function store(ConversationLogStoreRequest $request): ConversationLogResource
    {
        $conversationLog = ConversationLog::create($request->validated());

        return new ConversationLogResource($conversationLog);
    }

    public function show(Request $request, ConversationLog $conversationLog): ConversationLogResource
    {
        return new ConversationLogResource($conversationLog);
    }

    public function update(ConversationLogUpdateRequest $request, ConversationLog $conversationLog): ConversationLogResource
    {
        $conversationLog->update($request->validated());

        return new ConversationLogResource($conversationLog);
    }

    public function destroy(Request $request, ConversationLog $conversationLog): Response
    {
        $conversationLog->delete();

        return response()->noContent();
    }
}
