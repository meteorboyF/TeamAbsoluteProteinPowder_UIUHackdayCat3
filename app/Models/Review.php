<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'rating', // Integer 1-5
        'comment',
        'reviewable_id',
        'reviewable_type',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
