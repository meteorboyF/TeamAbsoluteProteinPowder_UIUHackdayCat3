<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'user_id',
        'commentable_id',
        'commentable_type',
    ];

    /**
     * Get the parent commentable model (post, video, etc.).
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
