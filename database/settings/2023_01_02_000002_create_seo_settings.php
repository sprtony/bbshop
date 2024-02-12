<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use App\Models\Permission;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('seo', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('title', null);
            $blueprint->add('favicon', null);
            $blueprint->add('logo', null);
            $blueprint->add('logo_footer', null);
            $blueprint->add('description', null);
            $blueprint->add('keywords', null);
            $blueprint->add('og_image', null);
            $blueprint->add('header', null);
        });

        Permission::create(['name' => 'manage Seo']);
    }
};
