<?php

namespace App\Models;

class AuditLog extends BaseModel
{
    protected $fillable = [
        'user_id',
        'auditable_type', // Polymorphic
        'auditable_id',
        'event', // created, updated, deleted
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
