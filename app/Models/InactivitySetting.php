<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InactivitySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'inactivity_threshold_days',
        'notification_days_before',
        'auto_release_enabled',
        'grace_period_days'
    ];

    protected $casts = [
        'auto_release_enabled' => 'boolean',
        'notification_days_before' => 'array'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
