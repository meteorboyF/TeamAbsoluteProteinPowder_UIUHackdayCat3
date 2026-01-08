<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reason',
        'description',
        'reportable_id',
        'reportable_type',
        'status' // pending, resolved, dismissed
    ];

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
