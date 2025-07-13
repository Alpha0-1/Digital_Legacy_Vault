<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'relationship',
        'notification_preference',
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'notification_preference' => 'array'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function legacyItems()
    {
        return $this->belongsToMany(LegacyItem::class);
    }

    public function legacyReleases()
    {
        return $this->hasMany(LegacyRelease::class);
    }
}
