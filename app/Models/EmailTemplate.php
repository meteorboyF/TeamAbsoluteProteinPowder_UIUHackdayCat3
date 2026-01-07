<?php

namespace App\Models;

class EmailTemplate extends BaseModel
{
    protected $fillable = [
        'slug', // e.g., 'welcome-email'
        'subject',
        'body_html', // HTML content with {{ variable }} placeholders
        'variables', // JSON array of available variables for hint
    ];

    protected $casts = [
        'variables' => 'array',
    ];
}
