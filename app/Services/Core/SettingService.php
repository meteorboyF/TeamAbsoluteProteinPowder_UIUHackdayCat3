<?php

namespace App\Services\Core;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService extends BaseService
{
    /**
     * Get a setting by key.
     */
    public function get(string $key, $default = null)
    {
        // Cache settings for performance, clear on set
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value.
     */
    public function set(string $key, $value, string $group = 'system'): Setting
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget("setting.{$key}");

        return $setting;
    }

    /**
     * Check if a setting exists.
     */
    public function has(string $key): bool
    {
        return Setting::where('key', $key)->exists();
    }
}
