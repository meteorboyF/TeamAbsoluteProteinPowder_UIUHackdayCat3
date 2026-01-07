<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Log extends BaseModel
{
    protected $fillable = [
        'subject_id',
        'subject_type', // The object being acted upon (e.g., User, Invoice)
        'causer_id',
        'causer_type',  // Who performed the action (e.g., User, Admin)
        'description',  // Human-readable description
        'properties',   // Extra data (JSON/Array)
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    /**
     * The model being tracked.
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * The user who performed the action.
     */
    public function causer()
    {
        return $this->morphTo();
    }
}
