<?php

namespace App\Models;

class Notification extends BaseModel
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'action_url',
        'type', // info, success, warning, error
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
