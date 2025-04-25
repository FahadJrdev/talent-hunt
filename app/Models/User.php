<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_image',
        'last_login',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
        'status' => 'string',
        'last_login' => 'timestamp',
    ];

    /**
     * Automatically hash passwords when setting
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::needsRehash($value) 
                ? Hash::make($value) 
                : $value,
        );
    }

    /**
     * Role checking helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isRecruiter(): bool
    {
        return $this->role === 'recruiter';
    }

    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    /**
     * Get the disk for profile images
     */
    public function profileImageDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

    /**
     * Get the URL to the profile image
     */
    public function profileImageUrl(): ?string
    {
        return $this->profile_image 
            ? \Storage::disk($this->profileImageDisk())->url($this->profile_image)
            : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
        });
    }
}