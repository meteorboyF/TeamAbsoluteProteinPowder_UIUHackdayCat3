<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mood extends Model
{
    protected $fillable = [
        'user_id',
        'mood',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the user that owns the mood
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
