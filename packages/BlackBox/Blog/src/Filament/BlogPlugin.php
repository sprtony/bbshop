<?php

namespace Quimaira\Blog\Filament;

use Quimaira\Blog\Filament\Resources\{BlogCategoryResource, BlogPostResource};

use Filament\Contracts\Plugin;
use Filament\Panel;

class BlogPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'blog';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                // BlogCategoryResource::class,
                BlogPostResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
    }
}
