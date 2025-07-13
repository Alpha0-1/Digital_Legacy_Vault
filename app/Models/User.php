<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Encryptable;
use App\Traits\HasInactivitySettings;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Encryptable, HasInactivitySettings;

    protected $fillable = [
        'name', 'email', 'password', 'two_factor_secret', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_secret'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function vault()
    {
        return $this->hasOne(Vault::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function legacyReleases()
    {
        return $this->hasMany(LegacyRelease::class);
    }

    // Check if user is considered inactive
    public function checkInactivity()
    {
        $inactivitySetting = $this->inactivitySetting;
        $lastActive = $this->last_activity_at ?? $this->updated_at;
        
        return now()->diffInDays($lastActive) > $inactivitySetting->inactivity_threshold_days;
    }
}
