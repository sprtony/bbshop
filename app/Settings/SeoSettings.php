<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public ?string $title;
    public ?string $favicon;
    public ?string $logo;
    public ?string $logo_footer;
    public ?string $description;
    public ?array $keywords;
    public ?string $og_image;
    public ?string $header;

    public static function group(): string
    {
        return 'seo';
    }
}
