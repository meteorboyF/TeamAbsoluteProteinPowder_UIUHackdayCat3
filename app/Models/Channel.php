<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type', // e.g., 'public', 'private', 'direct'
        'meta', // generic array for things like 'description', 'icon', etc.
        'member_ids', // Array of User IDs allowed in this channel
    ];

    protected $casts = [
        'meta' => 'array',
        'member_ids' => 'array',
    ];

    /**
     * Get all messages for this channel.
     * Since Message is polymorphic, we use morphMany.
     */
    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class, 'chatable');
    }

    // Check if user is member
    public function isMember($userId)
    {
        return in_array($userId, $this->member_ids ?? []);
    }
}
