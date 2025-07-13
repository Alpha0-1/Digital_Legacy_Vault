<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
use App\Policies\VaultPolicy;

class Vault extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'encryption_key', 'content', 'security_level'
    ];

    protected $hidden = [
        'encryption_key', 'content'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function legacyItems()
    {
        return $this->hasMany(LegacyItem::class);
    }

    public function beneficiaries()
    {
        return $this->hasManyThrough(Beneficiary::class, LegacyItem::class);
    }

    // Decrypt content for authorized users
    public function decryptContent($key)
    {
        if (!VaultPolicy::canAccess(auth()->user(), $this)) {
            throw new \Exception('Unauthorized access');
        }
        
        return decrypt($this->content, $key);
    }
}
