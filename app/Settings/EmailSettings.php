<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public ?string $email;
    public ?array $bcc;
    public ?string $logo;
    public ?string $color;

    public static function group(): string
    {
        return 'email';
    }
}
