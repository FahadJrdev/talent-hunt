<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'profile_image' => $this->profile_image,
            'last_login' => $this->last_login,
            'status' => $this->status,
            'chatbotFlows' => ChatbotFlowCollection::make($this->whenLoaded('chatbotFlows')),
        ];
    }
}
