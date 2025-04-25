<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'application_id' => $this->application_id,
            'step_id' => $this->step_id,
            'user_message' => $this->user_message,
            'bot_message' => $this->bot_message,
            'file_uploaded' => $this->file_uploaded,
            'file_path' => $this->file_path,
            'session_id' => $this->session_id,
        ];
    }
}
