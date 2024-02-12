<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Models\SettingsProperty;

class Settings
{
    public $setting_cache = null;

    public function setting($key, $default = null)
    {
        if (! Schema::hasTable('settings')) {
            return $default;
        }

        if ($this->setting_cache === null) {
            foreach (SettingsProperty::all() as $setting) {
                @$this->setting_cache[$setting->group][$setting->name] = json_decode($setting->getAttribute('payload'));
            }
        }

        $parts = explode('.', $key);

        if (count($parts) == 2) {
            return @$this->setting_cache[$parts[0]][$parts[1]] ?: $default;
        } else {
            return @$this->setting_cache[$parts[0]] ?: $default;
        }
    }
}
