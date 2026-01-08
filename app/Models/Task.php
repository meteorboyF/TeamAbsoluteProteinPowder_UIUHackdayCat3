<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'status', // todo, doing, done
        'priority', // low, medium, high
        'assignee_id',
        'taskable_id',
        'taskable_type'
    ];

    public function taskable(): MorphTo
    {
        return $this->morphTo();
    }
}
