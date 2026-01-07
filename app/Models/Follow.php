<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'follower_id', // User who is following
        'followed_id', // User being followed
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
