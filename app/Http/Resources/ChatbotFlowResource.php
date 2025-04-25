<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatbotFlowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_position_id' => $this->job_position_id,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'chatbotSteps' => ChatbotStepCollection::make($this->whenLoaded('chatbotSteps')),
        ];
    }
}
