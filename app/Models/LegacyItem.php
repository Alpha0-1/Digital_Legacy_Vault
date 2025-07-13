<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class LegacyItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'vault_id', 
        'title', 
        'content', 
        'item_type',
        'access_instructions'
    ];

    protected $hidden = [
        'content'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'release_date' => 'datetime'
    ];

    // Relationships
    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }

    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class);
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'loggable');
    }
}
