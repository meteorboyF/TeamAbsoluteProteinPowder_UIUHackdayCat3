<?php

namespace App\Models;

class BotPersona extends BaseModel
{
    protected $fillable = [
        'name',
        'slug', // e.g. 'support-bot', 'dungeon-master'
        'system_prompt',
        'greeting_message',
        'avatar_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActive(): ?self
    {
        return self::where('is_active', true)->first();
    }
}
