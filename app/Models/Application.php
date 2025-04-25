<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_position_id',
        'user_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'cv_file_path',
        'additional_info',
        'status',
        'notes',
        'last_status_change',
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
            'user_id' => 'integer',
            'additional_info' => 'array',
            'last_status_change' => 'datetime',
        ];
    }

    public function conversationLogs(): HasMany
    {
        return $this->hasMany(ConversationLog::class, 'application_id');
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
