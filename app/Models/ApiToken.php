<?php

namespace App\Models;

use Illuminate\Support\Str;

class ApiToken extends BaseModel
{
    protected $fillable = [
        'user_id',
        'name',
        'token',
        'last_used_at',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->token = Str::random(60);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
