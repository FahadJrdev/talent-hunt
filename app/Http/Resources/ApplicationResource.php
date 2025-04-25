<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_position_id' => $this->job_position_id,
            'user_id' => $this->user_id,
            'applicant_name' => $this->applicant_name,
            'applicant_email' => $this->applicant_email,
            'applicant_phone' => $this->applicant_phone,
            'cv_file_path' => $this->cv_file_path,
            'additional_info' => $this->additional_info,
            'status' => $this->status,
            'notes' => $this->notes,
            'last_status_change' => $this->last_status_change,
            'conversationLogs' => ConversationLogCollection::make($this->whenLoaded('conversationLogs')),
        ];
    }
}
