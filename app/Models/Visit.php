<?php

namespace App\Models;

class Visit extends BaseModel
{
    protected $fillable = [
        'ip_address',
        'url',
        'user_agent',
        'user_id'
    ];
}
