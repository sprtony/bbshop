<?php

namespace BlackBox\Catalog\Filament;

use BlackBox\Catalog\Filament\Resources\{CategoryResource, ProductResource, BrandResource};

use Filament\Contracts\Plugin;
use Filament\Panel;

class CatalogPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'catalog';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                CategoryResource::class,
                BrandResource::class,
                ProductResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
    }
}
