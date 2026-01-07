<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Poll extends Model
{
    protected $fillable = [
        'question',
        'options', // Array of option strings
        'votes', // Array of structure: ['user_id' => 'option_index']
        'pollable_id',
        'pollable_type',
        'is_active',
        'user_id' // Creator
    ];

    protected $casts = [
        'options' => 'array',
        'votes' => 'array',
        'is_active' => 'boolean',
    ];

    public function pollable(): MorphTo
    {
        return $this->morphTo();
    }
}
