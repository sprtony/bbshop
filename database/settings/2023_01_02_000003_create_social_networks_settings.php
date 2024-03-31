<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('social', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('whatsapp', null);
            $blueprint->add('phones', null);
            $blueprint->add('social_networks', null);
        });
    }
};
