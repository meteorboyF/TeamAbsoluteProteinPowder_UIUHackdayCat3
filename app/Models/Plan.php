<?php

namespace App\Models;

class Plan extends BaseModel
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'features', // Array of strings
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
