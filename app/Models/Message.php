<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'user_id',
        'chatable_id',
        'chatable_type',
        'emotion', // Added for Project US: Resonance
        'metadata', // Added for Project US: Flexibility
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the parent chatable model (project, classroom, ticket, etc.).
     */
    public function chatable(): MorphTo
    {
        return $this->morphTo();
    }
}
