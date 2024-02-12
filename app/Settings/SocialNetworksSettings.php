<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialNetworksSettings extends Settings
{
    public ?array $social_networks;
    public ?array $phones;
    public ?string $whatsapp;

    public static function group(): string
    {
        return 'social';
    }
}
