<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('email', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('email', null);
            $blueprint->add('bcc', null);
            $blueprint->add('logo', null);
            $blueprint->add('color', null);
        });
    }
};
