<?php

namespace App\Models;

class SeoSetting extends BaseModel
{
    protected $fillable = [
        'route_name', // e.g. 'home', 'pricing' or '*' for global
        'meta_title',
        'meta_description',
        'og_image',
    ];
}
