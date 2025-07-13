<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegacyRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'beneficiary_id',
        'vault_id',
        'release_date',
        'release_reason',
        'status',
        'released_by'
    ];

    protected $casts = [
        'release_date' => 'datetime',
        'status' => 'string'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }
}
