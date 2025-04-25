<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'department' => $this->department,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'responsibilities' => $this->responsibilities,
            'location' => $this->location,
            'salary_range' => $this->salary_range,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'chatbotFlows' => ChatbotFlowCollection::make($this->whenLoaded('chatbotFlows')),
        ];
    }
}
