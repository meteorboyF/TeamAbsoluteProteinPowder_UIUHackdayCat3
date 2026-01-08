<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'type', // e.g., 'comment_posted', 'project_created'
        'description',
        'subject_id',
        'subject_type', // Polymorphic subject (Project, Ticket, etc.)
        'meta', // Additional data (links, old_values, etc.)
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming User is standard model
    }
}
