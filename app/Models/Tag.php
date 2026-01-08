<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug', 'count'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($tag) {
            $tag->slug = \Illuminate\Support\Str::slug($tag->name);
        });
    }
}
