<?php

namespace App\Models;

class ChatMessage extends BaseModel
{
    protected $fillable = [
        'session_id', // Cookie ID or User ID
        'role', // 'user' or 'assistant'
        'content',
        'persona_id', // To track which persona generated this
    ];

    public function persona()
    {
        return $this->belongsTo(BotPersona::class);
    }
}
