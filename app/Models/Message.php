<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'user_id',
        'chatable_id',
        'chatable_type',
    ];

    /**
     * Get the parent chatable model (project, classroom, ticket, etc.).
     */
    public function chatable(): MorphTo
    {
        return $this->morphTo();
    }
}
