<?php

namespace App\Models;

class WebhookLog extends BaseModel
{
    protected $fillable = [
        'source', // stripe, github, custom
        'payload',
        'headers',
        'ip_address',
        'processed_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'headers' => 'array',
        'processed_at' => 'datetime',
    ];
}
