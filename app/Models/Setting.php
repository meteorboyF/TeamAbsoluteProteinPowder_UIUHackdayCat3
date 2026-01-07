<?php

namespace App\Models;

class Setting extends BaseModel
{
    protected $fillable = [
        'key',
        'value',
        'group', // e.g., 'site', 'mail', 'feature_flags'
    ];

    protected $casts = [
        'value' => 'json',
    ];
}
