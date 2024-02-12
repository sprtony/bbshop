<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $banner_url;
    public ?string $captcha_public;
    public ?string $captcha_private;
    public ?string $privacy;
    public ?string $terms;

    public static function group(): string
    {
        return 'general';
    }
}
