<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Models\SettingsProperty;

class Settings
{

    public function setting($key, $default = null)
    {

        $setting_cache = Cache::rememberForever('settings', fn () => $this->getSettings());

        [$group,$name] = explode('.', $key);

        return $setting_cache[$group][$name] ?? $default;

    }

    public function updateCache()
    {
        Cache::put('settings', $this->getSettings());
    }

    private function getSettings()
    {
        $settings = [];
        if (! Schema::hasTable('settings')) {
            return $settings;
        }

        foreach (SettingsProperty::all() as $setting) {
            $settings[$setting->group][$setting->name] = json_decode($setting->getAttribute('payload'));
        }

        return $settings;
    }
}
