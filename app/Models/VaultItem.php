<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VaultItem extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'file_path',
        'note',
        'unlock_at',
        'unlock_level',
        'is_hidden',
    ];

    protected $casts = [
        'unlock_at' => 'datetime',
        'is_hidden' => 'boolean',
    ];

    /**
     * Get the user that owns the vault item
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if item is locked (based on time OR level)
     */
    public function isLocked(?int $userLevel = null): bool
    {
        // Check date lock
        if ($this->unlock_at) {
            if ($this->unlock_at->isFuture()) {
                return true;
            }
        }

        // Check level lock
        if ($this->unlock_level && $userLevel !== null) {
            if ($userLevel < $this->unlock_level) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if item is unlocked (time-lock expired or never locked)
     */
    public function isUnlocked(): bool
    {
        if (!$this->unlock_at) {
            return true; // No time-lock
        }

        return $this->unlock_at->isPast();
    }

    /**
     * Get days until unlock
     */
    public function daysUntilUnlock(): ?int
    {
        if ($this->isUnlocked()) {
            return null;
        }

        return Carbon::now()->diffInDays($this->unlock_at, false);
    }
}
