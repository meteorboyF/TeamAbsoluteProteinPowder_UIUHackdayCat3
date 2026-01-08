<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XpLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'xp_amount',
    ];

    protected $casts = [
        'xp_amount' => 'integer',
    ];

    /**
     * Get the user that owns the XP log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
