<?php

namespace App\Models;

class Ticket extends BaseModel
{
    protected $fillable = [
        'user_id',
        'subject',
        'status', // open, closed, answered
        'priority', // low, medium, high
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
