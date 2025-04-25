<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatbotStep extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flow_id',
        'step_order',
        'message_text',
        'step_type',
        'expected_response_type',
        'options',
        'validation_rules',
        'next_step_logic',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'flow_id' => 'integer',
            'options' => 'array',
            'validation_rules' => 'array',
            'next_step_logic' => 'array',
        ];
    }

    public function conversationLogs(): HasMany
    {
        return $this->hasMany(ConversationLog::class);
    }

    public function flow(): BelongsTo
    {
        return $this->belongsTo(ChatbotFlow::class);
    }
}
