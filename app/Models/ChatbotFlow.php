<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatbotFlow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_position_id',
        'name',
        'is_active',
        'created_by',
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
            'job_position_id' => 'integer',
            'is_active' => 'boolean',
            'created_by' => 'integer',
        ];
    }

    public function chatbotSteps(): HasMany
    {
        return $this->hasMany(ChatbotStep::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
