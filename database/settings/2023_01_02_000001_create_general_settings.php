<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;
use App\Models\Permission;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('general', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('captcha_public', null);
            $blueprint->add('captcha_private', null);
            $blueprint->add('privacy', null);
            $blueprint->add('terms', null);
        });
        Permission::create(['name' => 'manage General']);
    }
};
