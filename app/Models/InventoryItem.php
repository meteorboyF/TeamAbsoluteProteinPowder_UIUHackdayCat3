<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type', // e.g., 'consumable', 'badge', 'currency'
        'quantity',
        'icon', // Emoji or URL
        'meta', // Extra stats
    ];

    protected $casts = [
        'quantity' => 'integer',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
