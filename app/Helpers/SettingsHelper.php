<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        return Cache::remember("settings.$key", now()->addDay(365), function () use ($key) {
            $setting = Setting::where('key', $key)->first();

            return $setting ? $setting->value : null;
        }) ?? $default;
    }

    public static function flushCache()
    {
        Cache::flush(); // Use this to clear all cached settings
    }
}
