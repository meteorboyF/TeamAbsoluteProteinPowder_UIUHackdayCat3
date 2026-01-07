<?php

namespace App\Models;

class Feature extends BaseModel
{
    protected $fillable = [
        'name',
        'key',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Helper to check if a feature is active
    public static function active(string $key): bool
    {
        // Cache could be added here
        $feature = self::where('key', $key)->first();
        return $feature ? $feature->is_active : false;
    }
}
