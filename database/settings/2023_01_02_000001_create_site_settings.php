<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('site', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('favicon', null);
            $blueprint->add('logo', null);
            $blueprint->add('logo_footer', null);
            $blueprint->add('captcha_public', null);
            $blueprint->add('captcha_private', null);
            $blueprint->add('privacy', null);
            $blueprint->add('terms', null);
            $blueprint->add('header', null);

            $blueprint->add('title', null);
            $blueprint->add('description', null);
            $blueprint->add('keywords', null);
            $blueprint->add('og_image', null);
        });
    }
};
