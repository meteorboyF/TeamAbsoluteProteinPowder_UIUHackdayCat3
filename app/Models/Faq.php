<?php

namespace App\Models;

class Faq extends BaseModel
{
    protected $fillable = [
        'question',
        'answer',
        'category',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
