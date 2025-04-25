<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatbotStepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'flow_id' => $this->flow_id,
            'step_order' => $this->step_order,
            'message_text' => $this->message_text,
            'step_type' => $this->step_type,
            'expected_response_type' => $this->expected_response_type,
            'options' => $this->options,
            'validation_rules' => $this->validation_rules,
            'next_step_logic' => $this->next_step_logic,
            'conversationLogs' => ConversationLogCollection::make($this->whenLoaded('conversationLogs')),
        ];
    }
}
